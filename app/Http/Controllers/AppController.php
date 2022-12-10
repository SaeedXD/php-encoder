<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Models\Pack;
use App\Classes\Encoder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AppController extends ApiController
{
    public function registerPack(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner' => 'required|min:3|max:64',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ])->stopOnFirstFailure(true);

        if ($validator->fails())
            return $this->errorResponse($validator->errors()->all()[0], 400);

        do {
            $token = Str::random(20);
        } while (Pack::where("token", "=", $token)->first());

        $validated = $validator->safe()->all();
        $fields = array_merge($validated, ['token' => $token]);
        if (Pack::insert($fields)) {
            return $this->successResponse($fields, 201, 'Registered.');
        } else {
            return $this->errorResponse('Unknow Error.', 400);
        }
    }

    public function uploadToPack(Request $request, $token)
    {
        $pack = Pack::where("token", "=", $token)->first();
        if ($pack) {
            if (!(strtolower(pathinfo($request->file->getClientOriginalName(), PATHINFO_EXTENSION)) == 'php' && $request->file->getClientMimeType() == 'application/octet-stream'))
                return $this->errorResponse('Bad file type.', 400);

            if ($request->file->getSize() > 15728640)
                return $this->errorResponse('Large file. (must be less than 15MB)', 400);

            $id = $pack->files + 1;
            $fileName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = $request->file->storeAs('files/' . $token . '/sources/' . $id, $fileName . '.orginal');

            $Encoder = new Encoder(
                Storage::disk('local')->get($filePath),
                rand(1100, 9700),
                rand(100, 1000),
            );

            Storage::disk('local')->put('files/' . $token . '/sources/' . $id . '/' . $fileName . '.encoded', $Encoder->Runner);
            Storage::disk('local')->put('files/' . $token . '/sources/' . $id . '/' . $Encoder->Encoded_Name, $Encoder->Encoded);

            $pack->files++;
            $pack->save();

            return $this->successResponse([
                'fileName' => $fileName . '.php'
            ], 200, "File has been encoded.");
        } else {
            return $this->errorResponse('Unknow Token.', 401);
        }
    }

    public function createDownloadLinkForPack($token)
    {
        $pack = Pack::where("token", "=", $token)->first();
        if ($pack) {
            $packPath = storage_path('app/files/' . $token);
            $path = storage_path('app');

            $files = Storage::disk('local')->directories('files/' . $token . '/sources');
            $downloads = Storage::disk('local')->files('files/' . $token);
            $download_id = count($downloads) + 1;

            if (count($files) > 0) {

                $zipName = str_replace(['/', '\\'], '-', $pack->owner);
                $zipName = Str::kebab($zipName);
                $zipName = Str::slug($zipName, '-');
                $zipName = $zipName . '-' . $download_id . '.zip';
                $zipPath = $packPath . '/' . $zipName;
                $zip = new \ZipArchive;
                if ($zip->open($zipPath, \ZipArchive::OVERWRITE | \ZipArchive::CREATE) === TRUE) {
                    foreach ($files as $dir_id => $dir) {
                        $dir_id += 1;
                        $dir_files = Storage::disk('local')->files($dir);

                        foreach ($dir_files as $filePath) {
                            $filePath = $path . '/' . $filePath;
                            $fileName = pathinfo($filePath, PATHINFO_FILENAME);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                            if ($fileExtension == 'encoded') {
                                $zip->addFile(
                                    $filePath,
                                    $dir_id . '/' . $fileName . '.php'
                                );
                                $zip->setEncryptionName(
                                    $dir_id . '/' . $fileName . '.php',
                                    \ZipArchive::EM_AES_256,
                                    $pack->password
                                );
                            } elseif (strtolower($fileExtension) == 'ste') {
                                $zip->addFile(
                                    $filePath,
                                    $dir_id . '/' . $fileName . '.STE'
                                );
                                $zip->setEncryptionName(
                                    $dir_id . '/' . $fileName . '.STE',
                                    \ZipArchive::EM_AES_256,
                                    $pack->password
                                );
                            }
                        }
                    }
                    $zip->setArchiveComment("≺⫽≻𝑫𝒆𝒗 𝒃𝒚 𝑺𝒂𝒆𝒆𝒅 𝑮𝒐𝒍𝒆𝒔𝒕𝒂𝒏𝒊 :)\n");
                    $zip->close();

                    do {
                        $dl_token = Str::random(20);
                    } while (Pack::where("token", "=", $dl_token)->first());

                    Link::insert([
                        'pack_id' => $pack->id,
                        'path' => $zipPath,
                        'files' => $pack->files,
                        'size' => filesize($zipPath),
                        'token' => $dl_token
                    ]);

                    return $this->successResponse([
                        'file' => $zipName,
                        'url' => url('/download/' . $dl_token),
                        'download_url' => url('/api/download/' . $dl_token),
                        'files' => $pack->files,
                        'size' => filesize($zipPath),
                        'token' => $dl_token
                    ], 200, 'link created.');
                } else {
                    return $this->errorResponse('Internal Server Error.', 500);
                }
            } else {
                return $this->errorResponse('There are no uploaded files.', 400);
            }
        } else {
            return $this->errorResponse('Unknow Token.', 401);
        }
    }

    public function downloadLink($token)
    {
        $link = Link::where("token", "=", $token)->first();
        if ($link) {
            if ($link->used == 0) {
                $link->used = 1;
                $link->save();
                return response()->download($link->path);
            } else {
                return $this->errorResponse('Download Link Has Been Expired.', 400);
            }
        } else {
            return $this->errorResponse('Bad Download Link.', 401);
        }
    }

    public function downloadPage($token)
    {
        $link = Link::where("token", "=", $token)->first();
        if ($link) {
            $pack = Pack::find($link->pack_id);
            $data = [
                'url' => url('/api/download/' . $token),
                'owner' => $pack->owner,
                'email' => $pack->email,
                'views' => $link->views+1,
                'file' => pathinfo($link->path, PATHINFO_BASENAME),
                'files' => $link->files,
                'size' => $link->size,
                'used' => $link->used,
            ];
            $link->views++;
            $link->save();
            return view('download', [
                'data'=>$data
            ]);
        } else {
            abort(404);
        }
    }
}

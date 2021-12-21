<?php
namespace App\Traits;

trait VersionValidationTrait
{
    public function versionValidation($newVersion, $latestVersion)
    {
        $latestVersionFetch = explode('.', $latestVersion->version_number);
        $newVersionFetch    = explode('.', $newVersion);
        $errors             = [];

        if($newVersionFetch[0] < $latestVersionFetch[0] || $newVersionFetch[1] < $latestVersionFetch[1] || $newVersionFetch[2] < $latestVersionFetch[2])
            $errors += ['Version number cant go backwards'];
        if($newVersion == $latestVersion->version_number)
            $errors += ['Version number already exists'];

        return $errors;
    }
}

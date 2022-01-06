<?php
namespace App\Traits;

use App\Models\ProjectVersion;

trait ProjectVersionTrait
{
    public function selectedVersion($versions, $versionId) {
        if(empty($versionId)) {
            $selectedVersion = $versions[0];
        } else {
            $selectedVersion = ProjectVersion::where('id', $versionId)->first();
        }

        return $selectedVersion;
    }
}

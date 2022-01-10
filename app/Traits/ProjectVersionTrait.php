<?php
namespace App\Traits;

use App\Models\ProjectVersion;

trait ProjectVersionTrait
{
    public function selectedVersion($versions, $versionId, $project) {
        if(empty($versionId)) {
            $selectedVersion = $versions[0];
        } else if($versionId == (new ProjectVersion)->generalVersion['all_version']) {
            $selectedVersion = $project;
        } else {
            $selectedVersion = ProjectVersion::where('id', $versionId)->first();
        }

        return $selectedVersion;
    }
}

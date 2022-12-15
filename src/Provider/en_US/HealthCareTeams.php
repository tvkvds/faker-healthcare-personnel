<?php

declare(strict_types=1);


namespace HealthcareTeamsFaker\Provider\en_US;

use Faker\Provider\Base;


class HealthCareTeams extends Base
{
    /*
     *  Returns a two part location name.
     *  Location name is created with multiple elements in altering compositions in a human-readable sequence.
     */
    public function location(): string
    {
        $locationName = '';
        $composition = static::randomElement(HealthCareTeamsData::$locationCompositions);

        foreach (HealthCareTeamsData::$locationNameElements as $nameElement)
        {
            match ($nameElement)
            {
                'location' => $locationName = $this->addElementWhenInComposition($composition, $nameElement, $locationName, 'Locatie '),
                'place' => $locationName = $this->addElementWhenInComposition($composition, $nameElement, $locationName, static::randomElement(HealthCareTeamsData::$locationPlaces)),
                'region' => $locationName = $this->addElementWhenInComposition($composition, $nameElement, $locationName, static::randomElement(HealthCareTeamsData::$locationRegions)),
                'prefix' => $locationName = $this->addElementWhenInComposition($composition, $nameElement, $locationName, static::randomElement(HealthCareTeamsData::$locationPrefix)),
                'tree' => $locationName = $this->addElementWhenInComposition($composition, $nameElement, $locationName, static::randomElement(HealthCareTeamsData::$locationTrees)),
                'name' => $locationName = $this->addElementWhenInComposition($composition, $nameElement, $locationName, static::randomElement(HealthCareTeamsData::$locationNames)),
                'suffix' => $locationName = $this->addElementWhenInComposition($composition, $nameElement, $locationName, static::randomElement(HealthCareTeamsData::$locationSuffix)),
            };
        }

        return trim($locationName);
    }

    /*
    *  Returns a two part team name that can be prepended with a location name.
    */
    public function team(string $location = null): string
    {
        $teamName = '';
        $composition = static::randomElement(HealthCareTeamsData::$teamCompositions);

        foreach (HealthCareTeamsData::$teamNameElements as $nameElement)
        {
            match ($nameElement)
            {
                'prefix' => $teamName = $this->addElementWhenInComposition($composition, $nameElement, $teamName, static::randomElement(HealthCareTeamsData::$teamPrefix)),
                'name' => $teamName = $this->addElementWhenInComposition($composition, $nameElement, $teamName, static::randomElement(HealthCareTeamsData::$teamNames)),
                'disease' => $teamName = $this->addElementWhenInComposition($composition, $nameElement, $teamName, static::randomElement(HealthCareTeamsData::$teamDiseases)),
                'care' => $teamName = $this->addElementWhenInComposition($composition, $nameElement, $teamName, static::randomElement(HealthCareTeamsData::$teamCare)),
                'suffix' => $teamName = $this->addElementWhenInComposition($composition, $nameElement, $teamName, static::randomElement(HealthCareTeamsData::$teamSuffix)),
            };
        }

        if($location)
        {
            $teamName = $location . ' ' . $teamName;
        }

        return trim($teamName);
    }

    /*
    *  Returns a one part function group name.
    */
    public function functionGroup(): string
    {
        $functionGroupName = '';
        $composition = static::randomElement(HealthCareTeamsData::$functionGroupCompositions);

        foreach (HealthCareTeamsData::$functionGroupNameElements as $nameElement)
        {
            match ($nameElement)
            {
                'name' => $functionGroupName = $this->addElementWhenInComposition($composition, $nameElement, $functionGroupName, static::randomElement(HealthCareTeamsData::$functionGroupNames)),
            };
        }

        return trim($functionGroupName);
    }

    /*
    *  Returns a one or two part function name.
    */
    public function function(): string
    {
        $functionName = '';
        $composition = static::randomElement(HealthCareTeamsData::$functionCompositions);

        foreach (HealthCareTeamsData::$functionNameElements as $nameElement)
        {
            match ($nameElement)
            {
                'prefix' => $functionName = $this->addElementWhenInComposition($composition, $nameElement, $functionName, static::randomElement(HealthCareTeamsData::$functionPrefix)),
                'name' => $functionName = $this->addElementWhenInComposition($composition, $nameElement, $functionName, static::randomElement(HealthCareTeamsData::$functionNames)),
            };
        }

        return trim($functionName);
    }

    public function specialisationGroup(): string
    {
        $specialisationGroupName = '';
        $composition = static::randomElement(HealthCareTeamsData::$specialisationGroupCompositions);

        foreach (HealthCareTeamsData::$specialisationGroupNameElements as $nameElement)
        {
            match ($nameElement)
            {
                'name' => $specialisationGroup = $this->addElementWhenInComposition($composition, $nameElement, $specialisationGroupName, static::randomElement(HealthCareTeamsData::$specialisationGroupNames)),
            };
        }

        return trim($specialisationGroup);
    }

    public function specialisation(): string
    {
        $specialisationName = '';
        $composition = static::randomElement(HealthCareTeamsData::$specialisationCompositions);

        foreach (HealthCareTeamsData::$specialisationNameElements as $nameElement)
        {
            match ($nameElement)
            {
                'name' => $specialisation = $this->addElementWhenInComposition($composition, $nameElement, $specialisationName, static::randomElement(HealthCareTeamsData::$specialisationNames)),
            };
        }

        return trim($specialisation);
    }

    /*
    *  Returns a one or two part function name.
    */
    public function contractType(): string
    {
        $contractTypeName = '';
        $composition = static::randomElement(HealthCareTeamsData::$contractTypeCompositions);

        foreach (HealthCareTeamsData::$contractTypeNameElements as $nameElement)
        {
            match ($nameElement)
            {
                'name' => $contractType = $this->addElementWhenInComposition($composition, $nameElement, $contractTypeName, static::randomElement(HealthCareTeamsData::$contractTypeNames)),
                'suffix' => $contractType = $this->addElementWhenInComposition($composition, $nameElement, $contractTypeName, 'Contract'),
            };
        }

        return trim($contractTypeName);
    }

    /*
    *  Adds extra part to a name when passed option is present in passed element.
    */
    public function addElementWhenInComposition(string $option, string $element, string $name, string $partName,): string
    {
        if(str_contains($option, $element))
        {
            $name .= $partName;
        }
        return $name;
    }
}


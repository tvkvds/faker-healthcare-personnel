<?php

namespace HealthcareTeamsFaker;

use PHPUnit\Framework\TestCase;
use Faker\Factory;

final class HealthCareTeamsTest extends TestCase
{

    protected array|false $folder;
    protected string $prefix = 'HealthcareTeamsFaker\Provider\\';
    protected string $suffix = '\HealthCareTeams';

    public function setUp(): void
    {
        $this->folder = array_diff(scandir('src/Provider'), array('..', '.'));
    }

    public function test_contract_type_returns_string_in_all_languages(): void
    {
        foreach ($this->folder as $folder) {
            $class = $this->prefix . $folder . $this->suffix;
            $faker = Factory::create();
            $faker->addProvider(new $class($faker));
            $this->assertIsString($faker->contractType());
        }
    }

    public function test_function_returns_string_in_all_languages(): void
    {
        foreach ($this->folder as $folder) {
            $class = $this->prefix . $folder . $this->suffix;
            $faker = Factory::create();
            $faker->addProvider(new $class($faker));
            $this->assertIsString($faker->function());
        }
    }

    public function test_function_group_returns_string_in_all_languages(): void
    {
        foreach ($this->folder as $folder) {
            $class = $this->prefix . $folder . $this->suffix;
            $faker = Factory::create();
            $faker->addProvider(new $class($faker));
            $this->assertIsString($faker->functionGroup());
        }
    }

    public function test_location_returns_string_in_all_languages(): void
    {
        foreach ($this->folder as $folder) {
            $class = $this->prefix . $folder . $this->suffix;
            $faker = Factory::create();
            $faker->addProvider(new $class($faker));
            $this->assertIsString($faker->location());
        }
    }

    public function test_specialisation_returns_string_in_all_languages(): void
    {
        foreach ($this->folder as $folder) {
            $class = $this->prefix . $folder . $this->suffix;
            $faker = Factory::create();
            $faker->addProvider(new $class($faker));
            $this->assertIsString($faker->specialisation());
        }
    }

    public function test_specialisation_group_returns_string_in_all_languages(): void
    {
        foreach ($this->folder as $folder) {
            $class = $this->prefix . $folder . $this->suffix;
            $faker = Factory::create();
            $faker->addProvider(new $class($faker));
            $this->assertIsString($faker->specialisationGroup());
        }
    }

    public function test_team_returns_string_in_all_languages(): void
    {
        foreach ($this->folder as $folder) {
            $class = $this->prefix . $folder . $this->suffix;
            $faker = Factory::create();
            $faker->addProvider(new $class($faker));
            $this->assertIsString($faker->team());
        }
    }

    public function test_team_can_be_prepended_with_location_in_all_languages(): void
    {
        foreach ($this->folder as $folder) {
            $class = $this->prefix . $folder . $this->suffix;
            $faker = Factory::create();
            $faker->addProvider(new $class($faker));

            $location = $faker->location();
            $team = $faker->team($location);

            $this->assertIsString($faker->team());
            $this->assertStringContainsString($location, $team);
        }
    }

    public function test_name_elements_are_correctly_parsed()
    {
        foreach ($this->folder as $folder) {

            $class = $this->prefix . $folder . $this->suffix;
            $faker = Factory::create();
            $faker->addProvider(new $class($faker));
            $provider = new $class($faker);

            // only test the parser when used
            if(! method_exists($provider, 'parseFromProperty') || ! property_exists($provider, 'contractTypeFormats'))
            {
                return;
            }

            // test the parser with a one part format
            $onePartResult = $faker->parseFromProperty($provider::$contractTypeFormats[0]);
            $this->assertContains($onePartResult, $provider::$contractTypeName);

            //test the parser with a mutiple part format
            $twoPartResult = $faker->parseFromProperty($provider::$contractTypeFormats[1]);
            $this->assertStringContainsString(' ', $twoPartResult);

            $parts = explode(' ', $twoPartResult);
            $this->assertContains(end($parts), $provider::$contractTypeSuffix);
            array_pop($parts);


            $this->assertContains(implode(" ",$parts), $provider::$contractTypeName);
        }
    }
}

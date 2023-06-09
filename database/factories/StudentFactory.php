<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $address = fake()->barangay() . "  " . fake()->municipality() . ", " . fake()->province();

        return [
            'lastname' => fake()->lastname(),
            'firstname' => fake()->firstname(),
            'middlename' => null,
            'extname' => null,
            'birth_date' => fake()->date(),
            'birth_place' => $address,
            'gender' => 'Male',
            'house_number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'subdivision' => '',
            'barangay' => fake()->barangay(),
            'city' => fake()->municipality(),
            'province' => fake()->province(),
            'zipcode' => fake()->randomNumber(4, true),
            'civil_status' => 'Single',
            'contact' => fake()->mobileNumber(),
            'is_cabuyeno' => 'Yes',
            'is_registered_voter' => 'Yes',
            'is_fully_vaccinated' => 'Yes',
            'father_name' => fake()->name(),
            'father_occupation' => 'Driver',
            'father_contact' => fake()->mobileNumber(),
            'is_father_voter_of_cabuyao' => 'Yes',
            'mother_name' => fake()->name(),
            'mother_occupation' => 'Accountant',
            'mother_contact' => fake()->mobileNumber(),
            'is_mother_voter_of_cabuyao' => 'Yes',
            'is_living_with_parents' => 'Yes',
            'education_attained' => 'Graduate',
            'last_school_attended' => 'PNC',
            'school_address' => $address,
            'award_received' => 'N/A',
            'sh_school_strand' => 'N/A',
            'email' => fake()->unique()->safeEmail(),
            'course_id' => 0,
            'year_level' => '1st',
            'user_type' => 'Student',            
            'status' => 'Uneditable',
        ];
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MedSystSeeder extends Seeder
{
    public function run(): void
    {
        
        $adminId = DB::table('users')->insertGetId([
            'name'              => 'Admin User',
            'email'             => 'admin@medsyst.com',
            'password'          => Hash::make('password'),
            'role'              => 'admin',
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        $doc1 = DB::table('users')->insertGetId([
            'name'              => 'Dr. Maria Santos',
            'email'             => 'santos@medsyst.com',
            'password'          => Hash::make('password'),
            'role'              => 'doctor',
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        $doc2 = DB::table('users')->insertGetId([
            'name'              => 'Dr. Jose Reyes',
            'email'             => 'reyes@medsyst.com',
            'password'          => Hash::make('password'),
            'role'              => 'doctor',
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

       
        $patients = [
            
            [
                'first_name'    => 'Unknown',
                'last_name'     => 'Walk-in',
                'age'           => null,
                'date_of_birth' => null,
                'gender'        => null,
                'contact'       => null,
                'address'       => null,
                'condition'     => 'Chest pain, loss of consciousness — emergency walk-in, no record',
                'priority'      => 'critical',
                'queue_prefix'  => 'E',
            ],
            [
                'first_name'    => 'Rodrigo',
                'last_name'     => 'Dela Cruz',
                'age'           => 54,
                'date_of_birth' => '1970-03-15',
                'gender'        => 'Male',
                'contact'       => '09171234567',
                'address'       => 'Brgy. Poblacion, Davao City',
                'condition'     => 'Severe head trauma from road accident',
                'priority'      => 'critical',
                'queue_prefix'  => 'E',
            ],
            [
                'first_name'    => 'Maria Lourdes',
                'last_name'     => 'Santos',
                'age'           => 71,
                'date_of_birth' => '1953-06-22',
                'gender'        => 'Female',
                'contact'       => '09189876543',
                'address'       => 'Brgy. Agdao, Davao City',
                'condition'     => 'Stroke symptoms — slurred speech, face drooping, arm weakness',
                'priority'      => 'critical',
                'queue_prefix'  => 'E',
            ],

            
            [
                'first_name'    => 'Jose',
                'last_name'     => 'Reyes',
                'age'           => 68,
                'date_of_birth' => '1956-01-10',
                'gender'        => 'Male',
                'contact'       => '09201112222',
                'address'       => 'Brgy. Talomo, Davao City',
                'condition'     => 'Hypertension — blood pressure 180/110, dizziness',
                'priority'      => 'urgent',
                'queue_prefix'  => 'P',
            ],
            [
                'first_name'    => 'Ana',
                'last_name'     => 'Concepcion',
                'age'           => 28,
                'date_of_birth' => '1996-08-05',
                'gender'        => 'Female',
                'contact'       => '09303334444',
                'address'       => 'Brgy. Buhangin, Davao City',
                'condition'     => 'Prenatal check-up — 28 weeks pregnant, mild abdominal cramps',
                'priority'      => 'urgent',
                'queue_prefix'  => 'P',
            ],
            [
                'first_name'    => 'Benjamin',
                'last_name'     => 'Palma',
                'age'           => 74,
                'date_of_birth' => '1950-11-30',
                'gender'        => 'Male',
                'contact'       => '09455556666',
                'address'       => 'Brgy. Matina, Davao City',
                'condition'     => 'Diabetes follow-up — high blood sugar reading, foot numbness',
                'priority'      => 'urgent',
                'queue_prefix'  => 'P',
            ],
            [
                'first_name'    => 'Lucia',
                'last_name'     => 'Fernandez',
                'age'           => 65,
                'date_of_birth' => '1959-04-18',
                'gender'        => 'Female',
                'contact'       => '09567778888',
                'address'       => 'Brgy. Toril, Davao City',
                'condition'     => 'Senior — severe knee pain, difficulty walking',
                'priority'      => 'urgent',
                'queue_prefix'  => 'P',
            ],

            
            [
                'first_name'    => 'Karl',
                'last_name'     => 'Mendoza',
                'age'           => 26,
                'date_of_birth' => '1998-07-12',
                'gender'        => 'Male',
                'contact'       => '09671112223',
                'address'       => 'Brgy. Panacan, Davao City',
                'condition'     => 'Fever and cough for 3 days, mild sore throat',
                'priority'      => 'normal',
                'queue_prefix'  => 'R',
            ],
            [
                'first_name'    => 'Liza',
                'last_name'     => 'Garcia',
                'age'           => 33,
                'date_of_birth' => '1991-02-28',
                'gender'        => 'Female',
                'contact'       => '09782223334',
                'address'       => 'Brgy. Communal, Davao City',
                'condition'     => 'Routine annual check-up',
                'priority'      => 'normal',
                'queue_prefix'  => 'R',
            ],
            [
                'first_name'    => 'Danny',
                'last_name'     => 'Pascual',
                'age'           => 45,
                'date_of_birth' => '1979-09-03',
                'gender'        => 'Male',
                'contact'       => '09893334445',
                'address'       => 'Brgy. Mintal, Davao City',
                'condition'     => 'Lower back pain, difficulty standing for long periods',
                'priority'      => 'normal',
                'queue_prefix'  => 'R',
            ],
            [
                'first_name'    => 'Grace',
                'last_name'     => 'Villanueva',
                'age'           => 19,
                'date_of_birth' => '2005-05-21',
                'gender'        => 'Female',
                'contact'       => '09104445556',
                'address'       => 'Brgy. Calinan, Davao City',
                'condition'     => 'Headache and dizziness, suspected migraine',
                'priority'      => 'normal',
                'queue_prefix'  => 'R',
            ],
            [
                'first_name'    => 'Roberto',
                'last_name'     => 'Aquino',
                'age'           => 38,
                'date_of_birth' => '1986-12-14',
                'gender'        => 'Male',
                'contact'       => '09215556667',
                'address'       => 'Brgy. Bago Aplaya, Davao City',
                'condition'     => 'Skin rash on arms and neck for one week',
                'priority'      => 'normal',
                'queue_prefix'  => 'R',
            ],
        ];

        
        $prefixCounters = ['E' => 1, 'P' => 1, 'R' => 1];
        $doctors        = [null, $doc1, $doc2, $doc1, null, $doc2, null, $doc1, null, $doc2, null, $doc1];
        $statuses       = ['waiting', 'waiting', 'called', 'waiting', 'waiting', 'serving', 'waiting', 'waiting', 'called', 'waiting', 'waiting', 'waiting'];

        foreach ($patients as $index => $data) {
           
            $patientId = DB::table('patients')->insertGetId([
                'first_name'    => $data['first_name'],
                'last_name'     => $data['last_name'],
                'age'           => $data['age'],
                'date_of_birth' => $data['date_of_birth'],
                'gender'        => $data['gender'],
                'contact'       => $data['contact'],
                'address'       => $data['address'],
                'condition'     => $data['condition'],
                'created_at'    => Carbon::now()->subMinutes(rand(5, 90)),
                'updated_at'    => now(),
            ]);

            $prefix      = $data['queue_prefix'];
            $queueNumber = $prefix . str_pad($prefixCounters[$prefix], 2, '0', STR_PAD_LEFT);
            $prefixCounters[$prefix]++;

            $status    = $statuses[$index] ?? 'waiting';
            $doctorId  = $doctors[$index] ?? null;
            $calledAt  = ($status === 'called' || $status === 'serving')
                ? Carbon::now()->subMinutes(rand(1, 10))
                : null;

            
            DB::table('queues')->insert([
                'patient_id'   => $patientId,
                'doctor_id'    => $doctorId,
                'queue_number' => $queueNumber,
                'priority'     => $data['priority'],
                'status'       => $status,
                'called_at'    => $calledAt,
                'created_at'   => Carbon::now()->subMinutes(rand(5, 90)),
                'updated_at'   => now(),
            ]);
        }

        $this->command->info('✅ MedSyst seeded: 3 emergency, 4 priority, 5 regular patients');
        $this->command->info('   Admin login  → admin@medsyst.com  / password');
        $this->command->info('   Doctor 1     → santos@medsyst.com / password');
        $this->command->info('   Doctor 2     → reyes@medsyst.com  / password');
    }
}
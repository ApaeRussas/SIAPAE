<?php return array (
  'Illuminate\\Foundation\\Support\\Providers\\EventServiceProvider' => 
  array (
    'App\\Events\\StudentCreated' => 
    array (
      0 => 'App\\Listeners\\CreateDonationForNewStudent@handle',
      1 => 'App\\Listeners\\CreateFrequencyList@handle',
    ),
    'App\\Events\\StudentUpdated' => 
    array (
      0 => 'App\\Listeners\\UpdateFrequencyList@handle',
    ),
  ),
);
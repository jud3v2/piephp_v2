<?php

function minutesToHumanDuration($minutes)
{
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;
        $duration = "";
    if ($hours > 0) {
            $duration .= $hours . "h";
    }
    if ($minutes > 0) {
            $duration .= ($hours > 0 ? " " : "") . $minutes . "min";
    }
        return $duration;
}

function dateToHumanReadableDate(string $date)
{
        $my_date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        $human_readable_date = $my_date->format('F d, Y');
        return $human_readable_date;
}

?>

<h1 class="text-7xl font-bold text-center my-5">{{ $d['film']['title'] }}</h1>
<h2 class="text-4xl font-bold">Information:</h2>
<ul class="list-disc">
    <li>
        Genre: {{ $d['genre']['name'] }}
    </li>
    <li>
        Durée: {{ minutesToHumanDuration($d['film']['duration']) }}
    </li>
    <li>
        Date de sortie: {{ dateToHumanReadableDate($d['film']['release_date']) }}
    </li>
    <li>
        Synopsis: {{ $d['film']['synopsis'] }}
    </li>
    <li>
        Directeur: {{ $d['film']['director'] }}
    </li>
    <li>
        @if($d['film']['rating'] == 'G')
            <p>Type de public: Tout public</p>
        @elseif($d['film']['rating'] == 'PG')
            <p>Type de public: Déconseillé aux jeunes enfants</p>
        @elseif($d['film']['rating'] == 'PG-13')
            <p>Type de public: Déconseillé aux moins de 13 ans</p>
        @elseif($d['film']['rating'] == 'R')
            <p>Type de public: Interdit aux moins de 17 ans</p>
        @elseif($d['film']['rating'] == 'NC-17')
            <p>Type de public: Interdit aux moins de 18 ans</p>
        @else
            <p>Type de public: Inconnu</p>
        @endif
    </li>
</ul>
<h2 class="text-4xl font-bold my-5">Distributeur:</h2>
<ul class="list-disc mb-5">
    <li>
        Nom du distributeur : {{ $d['distributor']['name'] }}
    </li>
    <li>
        Adresse : {{ $d['distributor']['address'] }}
    </li>
    <li>
        Code postal : {{ $d['distributor']['zipcode'] }}
    </li>
    <li>
        Ville : {{ $d['distributor']['city'] }}
    </li>
    <li>
        Pays : {{ $d['distributor']['country'] }}
    </li>
    <li>
        Téléphone : {{ $d['distributor']['phone'] }}
    </li>
</ul>
<div class="my-5">
    <a href="/movie/update/{{ $d['film']['id'] }}"
       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Modifier</a>
    <a href="/movie/delete/{{ $d['film']['id'] }}"
       class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
        Supprimer</a>
</div>
<h2 class="text-4xl font-bold mt-5">Séance programmé: </h2>
<hr class="my-3">
<table class="table-auto w-full my-5 px-3">
    <thead>
    <tr>
        <th class="w-1/5 text-center">Salle</th>
        <th class="w-1/5 text-center">N° de salle</th>
        <th class="w-1/5 text-center">N° Étage</th>
        <th class="w-1/5 text-center">Nbr de place</th>
        <th class="w-1/5 text-center">Date de début</th>
    </tr>
    </thead>
    <tbody class="mb-5">
    @foreach($d['movieSchedule'] as $schedule)
        <tr class="mt-2">
            <td class="mt-2 text-center">{{ $schedule['room']['name'] }}</td>
            <td class="mt-2 text-center">{{ $schedule['room']['number'] }}</td>
            <td class="mt-2 text-center">{{ $schedule['room']['floor'] }}</td>
            <td class="mt-2 text-center">{{ $schedule['room']['seats'] }}</td>
            <td class="mt-2 text-center">{{ date("F jS, Y", strtotime($schedule['date_begin'])) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
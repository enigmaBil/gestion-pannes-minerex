<!DOCTYPE html>
<html>
<head>
    <title>Fiche de Stock</title>
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Times New Roman";
            font-size: 14px;
        }
        /* Styles pour l'en-tête */
        .header {
            width: 100%;
            padding-bottom: 10px;
            margin: 20px;
        }
        .header table {
            width: 100%;
            border-collapse: collapse;
        }
        .header td {
            vertical-align: top;
            width: 33%; /* Chaque colonne aura une largeur égale */
            text-align: center; /* Centrer le texte */
        }
        .header img {
            height: 100px; /* Ajuster la hauteur du logo */
            width: auto; /* Conserver les proportions du logo */
            margin: 0 10px; /* Espacement autour du logo */
        }
        /* Styles pour le tableau */
        .tab {
            width: 100%;
            border-collapse: collapse;
            margin: 0px;
        }
        .tab th, .tab td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .tab th {
            background-color: #f2f2f2;
        }
        .footer {
            bottom: 0;
            padding: 10px 0;
            border-top: 1px solid #000; /* Ligne au-dessus du pied de page */
            font-size: 12px; /* Taille de police pour le pied de page */
        }
        .content {
            margin-top: 30px; /* Espacement pour l'en-tête */
            margin-bottom: 100px; /* Espacement pour le pied de page */
            margin-left: 40px;
            margin-right: 40px;
        }
        body {
            margin: 30px 0;
            min-height: 1000%; /* Pour que le corps prenne au moins toute la hauteur de la page */
        }
         .footer {
            width: 600px;
             margin: auto;
            text-align: center;
            position: fixed;
            left: 0;
            right: 0;
        }
        .header {
            top: 0;
            position: relative;
        }

    </style>
</head>
<body >
<!-- En-tête avec le logo et le titre -->
<div class="header">
    <table>
        <tr>
            <td style="">
                <h3 style="text-transform: uppercase; font-size: 14px">République du Cameroun</h3>
                <span style="font-size: 9px">Paix - Travail - Patrie</span><br>
                <span style="font-size: 9px">*********</span>
                <h4 style="text-transform: uppercase; font-size: 12px">Ministère des relations extérieures</h4>
                <span style="font-size: 9px">*********</span><br>
                <span style="text-transform: uppercase;font-size: 12px">Secrétariat général</span><br>
                <span style="font-size: 9px">*********</span><br>
                <span style="text-transform: uppercase;font-size: 12px">Cellule des nouvelles technologies et de la cryptographie</span><br>
                <span style="font-size: 9px">*********</span><br><br>
                <span><em>N°___________ DIPL/SG/CNT/CEAS</em></span>
            </td>
            <td>
                <img src="{{ public_path('backend/dist/img/logo_minrex.png') }}" alt="Logo MINEREX">
            </td>
            <td style="width: 40%;">
                <h3 style="text-transform: uppercase; font-size: 14px">Republic of Cameroon</h3>
                <span style="font-size: 9px">Peace - Work - Fatherland</span><br>
                <span style="font-size: 9px">*********</span>
                <h4 style="text-transform: uppercase; font-size: 12px">Ministry of External Relations</h4>
                <span style="font-size: 9px">*********</span><br>
                <span style="text-transform: uppercase;font-size: 12px">Secretariat General</span><br>
                <span style="font-size: 9px">*********</span><br>
                <span style="text-transform: uppercase;font-size: 12px">New Technologies and <br>Cryptography Unit</span><br>
                <span style="font-size: 9px">*********</span><br><br>
                <span><em>Yaounde,</em></span>
            </td>
        </tr>
    </table>
</div>

<!-- Contenu principal -->
<div class="content">
    <h2>Fiche de Stock</h2>
    <table class="tab">
        <thead>
        <tr>
            <th>#</th>
            <th>Designation</th>
            <th>Quantité</th>
            <th>Emplacement de stockage</th>
            <th>Date de réception</th>
        </tr>
        </thead>
        <tbody>
        @foreach($stocks as $stock)
            <tr>
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->product_name }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>{{ $stock->location }}</td>
                <td>{{ $stock->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="footer">

    <div style="text-align: center; font-size: 8px; width: 500px; margin: auto">
        <p>
            Ministère des Relations Extérieures, 703, Rue 1025 Hippodrome B.P. 18 Yaoundé 1<sup>er</sup>
        </p>
        <p>
            Ministry of External Relations, 703, Street 1025 Hippodrome B.P. 18 Yaounde 1st
        </p>
        <p>
            TEL: + (237) 222 20 30 27, Email: diplocam.cnt@diplocam.cm, site web: <a href="https://diplocam.cm/">www.diplocam.cm</a>
        </p>
    </div>
</div>
</body>
</html>

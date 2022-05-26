<center>

    <h1> Formulaire <?=$data==null?" d'insertion":"de modification"?> </h1>
    <form action="<?=$data==null?"store":"../update/".$data->id?>" method="post">
        <table>
            <tr>
                <td>Nom</td>
                <td><input type="text" name="nom" value="<?=$data!=null?$data->nom:""?>"></td>
            </tr>
            <tr>
                <td>Prénom</td>
                <td><input type="text" name="prenom" value="<?=$data!=null?$data->prenom:""?>"></td>
            </tr>
            <tr>
                <td>Spécialité</td>
                <td><input type="text" name="specialite" value="<?=$data!=null?$data->specialite:""?>"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Envoyer"></td>
                <td><input type="reset" value="Annuler"></td>
            </tr>
        </table>






    </form>

</center>
<?php


class Book extends Products implements Calling
{

    // query to save value from the form
    public function setValue()
    {
        global $data;

        if (isset($_POST['save_product'])) {

            if (isset($_POST['type-switcher'])) {

                if (empty($_POST['weight'])) {
                    echo "";
                }
            }

            $sku = $this->clean($_POST['sku']);
            $name = $this->clean($_POST['name']);
            $price = $this->clean($_POST['price']);
            $type = $this->clean($_POST['type-switcher']);
            $weight = $this->clean($_POST['weight']);

            $sql = "INSERT INTO product (sku, name , price, type, weight) VALUES('$sku', '$name', '$price', '$type', '$weight') ";

            $data->query($sql);

            header("Location: index.php");
            exit();
        }
    }

    // query to get value from the database and to display it in card form
    public function getValue()
    {
        global $data;

        $query = "SELECT id, sku, name, price, weight FROM product WHERE type = 'book' ";

        $result = $data->query($query);

        while ($row = mysqli_fetch_array($result)) {

            $id = $row['id'];
            $sku = $row['sku'];
            $name = $row['name'];
            $price = $row['price'];
            $weight = $row['weight'];

            echo "
            <div class='row' id='display'> 
                <div class='col' id='info'> 
                    <div class='card' style = 'margin: 0; padding-top: 0.5rem; padding-bottom:0.5rem; dispaly: flex;'>
                        <div class='card-body info' style= 'dispaly: flex; margin: 0; padding: 0;'>
                            <input id= 'chk_all' type='checkbox' class='delete-checkbox' name='delete-checkbox[]' value='$id'>
                            <div class='items text-center' style='justify-content:center; align-items: center; margin: 0; padding: 0;'>
                                
                                <table style='justify-content:center; align-items: center; margin: 0; padding: 0;'> 
                                    <tbody >
                                        <tr class='row' style='font-weight: bold; font-size: 1.2rem;'> 
                                        <td> " . $sku . "</td>
                                            <td> " . $name . "</td>
                                            <td>" . $price . "$" . "</td>                   
                                            <td>" . "Weight: " . $weight . "KG" . "</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>";
        }
    }

    // function to manage product choice
    public function call()
    {
        return $this->setValue();
    }
}

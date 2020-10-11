<?php
    class SprintItemCopyController extends Controller{

        public function collection(){
            $sprint_item_copy = SprintItemCopy::all();
            $response = [
                "data" => $sprint_item_copy
            ];
            return $response;
        }

        public function store($sprint_item_copy){
            try{
                validate(SprintItemCopy::class, $sprint_item_copy);
                $new_sprint_item_copy = new SprintItemCopy();
                $new_sprint_item_copy->back_log_item_id = $sprint_item_copy->back_log_item_id;
                $new_sprint_item_copy->status_id = $sprint_item_copy->status_id;
                $new_sprint_item_copy->sprint_id = $sprint_item_copy->sprint_id;
                $new_sprint_item_copy->item_display_order = $sprint_item_copy->item_display_order;
                $new_sprint_item_copy->save();
                $response = [
                    "message" => "inserted succesfully"
                ];
                return response($response);
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }

        public function storeOrder(){
            $link = mysqli_connect("localhost","root","","app-log-database");
            $ids = $_POST['ids'];
            $arr = explode(',',$ids);
            for($i=1; $i<=count($arr); $i++)
            {
	            $strSQL = "UPDATE sprint_items_copy SET item_display_order = ".$i." WHERE sprint_item_id = ".$arr[$i-1];
	            mysqli_query($link, $strSQL);
            }
        }

        public function show($id){
            $sprint_item_copy = new SprintItemCopy(SprintItemCopy::find($id));
            return $sprint_item_copy;
        }

        public function update($id, $new_sprint_item_copy){
            try{
                validate(SprintItemCopy::class, $new_sprint_item_copy);
                $sprint_item_copy = new SprintItemCopy(SprintItemCopy::find($id));
                if(!empty($sprint_item_copy)){
                    $sprint_item_copy->back_log_item_id = $new_sprint_item_copy->back_log_item_id;
                    $sprint_item_copy->status_id = $new_sprint_item_copy->status_id;
                    $sprint_item_copy->sprint_id = $new_sprint_item_copy->sprint_id;
                    $new_sprint_item_copy->item_display_order = $sprint_item_copy->item_display_order;
                    $sprint_item_copy->save();
                    $response = [
                        "message" => "updated succesfully"
                    ];
                    return response($response);
                }else{
                    echo "sprint item not found";
                }
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function destroy($id){
            $sprint_item_copy = new SprintItemCopy(SprintItemCopy::find($id));
            if(!empty($sprint_item_copy)){
                if($sprint_item_copy->delete()){
                    $response = [
                        "message" => "deleted succesfully"
                    ];
                    return response($response);
                }
            }else{
                echo "Sprint item not found";
            }
        }
    }
?>
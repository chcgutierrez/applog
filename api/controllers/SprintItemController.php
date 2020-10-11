<?php
    class SprintItemController extends Controller{
        public function collection(){
            $sprint_item = SprintItem::all();
            $response = [
                "data" => $sprint_item
            ];
            return $response;
        }
        public function store($sprint_item){
            try{
                validate(SprintItem::class, $sprint_item);
                $new_sprint_item = new SprintItem();
                $new_sprint_item->back_log_item_id = $sprint_item->back_log_item_id;
                $new_sprint_item->status_id = $sprint_item->status_id;
                $new_sprint_item->sprint_id = $sprint_item->sprint_id;
                $new_sprint_item->save();
                $response = [
                    "message" => "inserted succesfully"
                ];
                return response($response);
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }

        public function show($id){
            $sprint_item = new SprintItem(SprintItem::find($id));
            return $sprint_item;
        }

        public function update($id, $new_sprint_item){
            try{
                validate(SprintItem::class, $new_sprint_item);
                $sprint_item = new SprintItem(SprintItem::find($id));
                if(!empty($sprint_item)){
                    $sprint_item->back_log_item_id = $new_sprint_item->back_log_item_id;
                    $sprint_item->status_id = $new_sprint_item->status_id;
                    $sprint_item->sprint_id = $new_sprint_item->sprint_id;
                    $sprint_item->save();
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
            $sprint_item = new SprintItem(SprintItem::find($id));
            if(!empty($sprint_item)){
                if($sprint_item->delete()){
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
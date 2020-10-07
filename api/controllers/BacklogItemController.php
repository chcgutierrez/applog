<?php
    class BacklogItemController extends Controller{
        public function collection(){
            $backlog_items = BacklogItem::all();
            $response = [
                "data" => $backlog_items
            ];
            return $response;
        }
        public function store($backlog_item){
            try{
                validate(BacklogItem::class, $backlog_item);
                $new_backlog_item = new BacklogItem();
                $new_backlog_item->backlog_item_name = $backlog_item->backlog_item_name;
                $new_backlog_item->backlog_item_description = $backlog_item->backlog_item_description;
                $new_backlog_item->backlog_item_effort = $backlog_item->backlog_item_effort;
                $new_backlog_item->backlog_id = $backlog_item->backlog_id;
                $new_backlog_item->status_id = $backlog_item->status_id;
                $new_backlog_item->save();
                $response = [
                    "message" => "inserted succesfully"
                ];
                return response($response);
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function show($id){
            $backlog_item = new BacklogItem(BacklogItem::find($id));
            return $backlog_item;
        }
        public function update($id, $new_backlog_item){
            try{
                validate(Backlog::class, $new_backlog_item);
                $backlog_item = new Backlog(Backlog::find($id));
                if(!empty($backlog)){
                    $backlog_item->backlog_name = $new_backlog_item->backlog_name;
                    $backlog_item->user_id = $new_backlog_item->user_id;
                    $backlog_item->save();
                    $response = [
                        "message" => "updated succesfully"
                    ];
                    return response($response);
                }else{
                    echo "role not found";
                }
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function destroy($id){
            $backlog_item = new BacklogItem(BacklogItem::find($id));
            if(!empty($backlog_item)){
                if($backlog_item->delete()){
                    $response = [
                        "message" => "deleted succesfully"
                    ];
                    return response($response);
                }
            }else{
                echo "Backlog item not found";
            }
        }
    }
?>
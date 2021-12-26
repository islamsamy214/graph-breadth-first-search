<?php 

class BFS{
    private $graph = [];
    private $search_queue = [];
    private $searched = [];
    private $family = [];

    public function __construct(){
        $this->graph['me'] = ['jerry','spike','tom'];
        $this->graph['jerry'] = ['snoop dog', 'g-ezi','tom'];
        $this->graph['tom'] = ['leonardo decaprio', 'alpacino','spike'];
        $this->graph['spike'] = ['his little boy'];
    }

    public function search($whoseSearching){
        $this->search_queue = $this->graph[$whoseSearching];
        while ($this->search_queue) {
            $person = array_shift($this->search_queue);
            if(!array_search($person,$this->searched)){
                
                if ($this->is_drag_deller($person)){
                    echo $person . ' is a drug deller';
                    print_r($this->parents($person));
                    return true;
                }
                
                $this->search_queue = array_merge($this->search_queue,$this->graph[$person]);
                array_unshift($this->searched,$person);
            }
        }

        echo 'it seems like i found no one';
        return false;
    }

    public function is_drag_deller($person){
        return $person == 'snoop dog' ? true : false;
    }

    public function parents($person){
        foreach ($this->searched as $parent){
            
            if(array_search($person,$this->graph[$parent])){
                array_unshift($this->family,$parent);
                $this->parents($parent);
            }
        }
        return $this->family;
        
    }
}

$testingBoy = new BFS();
$testingBoy->search('me');

?>
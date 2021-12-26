<?php

class BFS
{
    private $graph = [];
    private $search_queue = [];
    private $searched = [];
    private $family = [];

    public function __construct()
    {
        $this->graph['me'] = ['spike', 'tom', 'jerry'];
        $this->graph['jerry'] = ['snoop dog', 'g-ezi', 'tom'];
        $this->graph['tom'] = ['leonardo decaprio', 'alpacino', 'spike'];
        $this->graph['spike'] = ['his little boy'];
    }//end of construct

    public function search($whoseSearching)
    {
        $this->search_queue = $this->graph[$whoseSearching];

        while ($this->search_queue) {

            $person = array_shift($this->search_queue);

            if (!array_search($person, $this->searched)) {

                if ($this->isDrugDealer($person)) {

                    echo $person . ' is a drug dealer and i reahced to him ';
                    //to detect the path
                    foreach ($this->parents($person) as $parent) {
                        echo ' throw ' . $parent;
                    }
                    return true;
                }
                if (isset($this->graph[$person])) {
                    $this->search_queue = array_merge($this->search_queue, $this->graph[$person]);
                }

                array_unshift($this->searched, $person);
            }
        }

        echo 'it seems like i found no one';
        return false;
    }//end of search

    public function isDrugDealer($person)
    {
        return $person == 'snoop dog' ? true : false;
    } //end of is_drag_deller

    //to detect the, how i reached to this element
    public function parents($person)
    {
        foreach ($this->searched as $parent) {
            if ($this->hasParent($parent, $person)) {

                array_unshift($this->family, $parent);

                $this->parents($parent);
            }
        }

        return $this->family;
    } //end of parents

    public function hasParent($parent, $person)
    {
        return isset($this->graph[$parent]) && is_int(array_search($person, $this->graph[$parent]));
    }//end of hasParent
}

$testingBoy = new BFS();
$testingBoy->search('me');

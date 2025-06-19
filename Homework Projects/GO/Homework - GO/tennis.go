package main

import (
	"fmt"
	"math/rand"
	"sync"
	"time"
)

var wg sync.WaitGroup

func init() {
	rand.Seed(time.Now().UnixNano())
}

func main() {
	//one shared int named court
	court := make(chan int)

	//wait group: 2 tennis players
	wg.Add(2)

	go player("Nadal", court)
	go player("Djokovic", court)

	//init court to 1 - syntax for channel
	court <- 1

	wg.Wait() //wait for both to finish
}

func player(name string, court chan int) {
	defer wg.Done()

	for {
		ball, ok := <-court

		if (!ok) {
			fmt.Printf("%s Won!\n", name)
			return
		}

		n := rand.Intn(100)
		if(n % 13 == 0) {
			close(court)
			return
		}

		fmt.Printf("Player %s Hit %d\n", name, ball)
		ball++

		court <- ball
	}
}

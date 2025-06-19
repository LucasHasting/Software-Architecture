package main

import (
	"fmt"
	"time"
)

func printMessage(msg string){
	for i := 0; i < 10; i++ {
		fmt.Println(msg)
		time.Sleep(100 * time.Millisecond) //10th of a second
	}
}

func main() {
	go printMessage("Hi") //go routine, function in async 
	printMessage("there")
}

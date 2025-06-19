package main

import (
	"fmt"
	"net/http"
	"time"
)

func handler(response http.ResponseWriter, request *http.Request) {
	fmt.Fprintf(response, "<html> <h1>Lucas Hasting: </h1> <h2>Request recieved at: " +
	time.Now().Format(time.RFC1123) + "</h2></html>")
}

func main() {
	http.HandleFunc("/", handler)

	http.ListenAndServe(":8080", nil)
}
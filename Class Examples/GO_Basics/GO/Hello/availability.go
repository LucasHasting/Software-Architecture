package main

import (
    "fmt"
    "net/http"
    //"time"
)

type Result struct {
    url    string
    status string
}

func checkAvailability(url string, results chan Result) {
    resp, err := http.Get(url)
    if err != nil {
        results <- Result{url, "Error"}
        return
    }
    defer resp.Body.Close()

    results <- Result{url, resp.Status}
}

func main() {
    websites := []string{
        "https://www.google.com",
        "https://www.github.com",
        "https://www.unalinos.edu",
        "https://www.una.edu",
        "https://roarlions.com",
    }

    // allocate memory for channel buffers
    // (make is also used for slices and maps)
    results := make(chan Result, len(websites))

    for _, url := range websites {
        go checkAvailability(url, results)
    }

    for i := 0; i < len(websites); i++ {
        result := <-results
        fmt.Printf("%s -> %s\n", result.url, result.status)
    }
}

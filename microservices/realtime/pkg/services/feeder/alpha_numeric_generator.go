package feeder

import (
	"math/rand"
	"time"
)

func RandomAlphaNum(length int) string {
	characters := "0123456789abcdefghijklmnopqrstuvwxyz"
	return generateRandomString(characters, length)
}

func RandomNumeric(length int) string {
	characters := "0123456789"
	return generateRandomString(characters, length)
}

func generateRandomString(characters string, length int) string {
	rand.Seed(time.Now().UnixNano())
	charactersLength := len(characters)
	randomString := make([]byte, length)
	for i := 0; i < length; i++ {
		randomString[i] = characters[rand.Intn(charactersLength)]
	}
	return string(randomString)
}

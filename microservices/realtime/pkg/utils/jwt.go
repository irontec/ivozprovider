package utils

import (
	"crypto/rsa"
	"encoding/json"
	"errors"
	"io/ioutil"

	"github.com/golang-jwt/jwt"
	"irontec.com/realtime/pkg/config"
)

type TokenPayload struct {
	Username *string  `json:"username"`
	Roles    []string `json:"roles"`
}

type AuthData struct {
	Auth string `json:"auth"`
}

var jwtPublicCert *rsa.PublicKey

func LoadJWTCryptoData() error {
	publicCertBytes, err := ioutil.ReadFile(config.GetJWTCertificate())
	if err != nil {
		return err
	}
	jwtPublicCert, err = jwt.ParseRSAPublicKeyFromPEM(publicCertBytes)
	if err != nil {
		return err
	}

	return nil
}

func GetPayload(authData string) *AuthData {

	var data AuthData
	if err := json.Unmarshal([]byte(authData), &data); err != nil {
		return &data
	}

	return &data
}

func GetToken(tokenString string) (*jwt.Token, error) {
	token, err := jwt.Parse(tokenString, func(token *jwt.Token) (interface{}, error) {
		return jwtPublicCert, nil
	})

	if err != nil {
		return nil, errors.New("error parsing token")
	}

	return token, nil
}

func Decode(token *jwt.Token) (*TokenPayload, error) {
	if token.Valid {
		// Access the claims from the token
		claims, ok := token.Claims.(jwt.MapClaims)
		if !ok {
			return nil, errors.New("error accessing claims")
		}

		claim := TokenPayload{
			Username: toString(claims["username"]),
			Roles:    toStringSlice(claims["roles"]),
		}
		return &claim, nil
	} else {
		return nil, errors.New("invalid token")
	}
}

func toString(value interface{}) *string {
	if str, ok := value.(string); ok {
		return &str
	}
	return nil
}

func toStringSlice(slice interface{}) []string {
	strSlice := []string{}
	if roles, ok := slice.([]interface{}); ok {
		for _, role := range roles {
			strSlice = append(strSlice, role.(string))
		}
	}
	return strSlice
}

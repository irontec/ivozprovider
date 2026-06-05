package config

import (
	"github.com/sirupsen/logrus"
	"github.com/spf13/viper"
)

func InitConfig() error {
	viper.SetConfigName("config")
	viper.SetConfigType("yaml")
	viper.AddConfigPath("/opt/irontec/ivozprovider/microservices/click2call/configs")

	return viper.ReadInConfig()
}

// -- server --
func GetListenAddress() string    { return viper.GetString("server.listen") }
func GetTLSCert() string          { return viper.GetString("server.tls_cert") }
func GetTLSKey() string           { return viper.GetString("server.tls_key") }
func GetAllowedOrigins() []string { return viper.GetStringSlice("server.allowed_origins") }

// -- digest --
func GetDigestSecret() string { return viper.GetString("digest.secret") }
func GetNonceTTL() int        { return viper.GetInt("digest.nonce_ttl") }

// -- db --
func GetDBHost() string     { return viper.GetString("db.host") }
func GetDBPort() int        { return viper.GetInt("db.port") }
func GetDBUser() string     { return viper.GetString("db.user") }
func GetDBPassword() string { return viper.GetString("db.password") }
func GetDBName() string     { return viper.GetString("db.name") }

// -- ami --
func GetAMIUser() string   { return viper.GetString("ami.user") }
func GetAMISecret() string { return viper.GetString("ami.secret") }
func GetAMIPort() int      { return viper.GetInt("ami.port") }

// -- kamailio --
func GetKamailioRPCURL() string { return viper.GetString("kamailio.rpc_url") }

// -- call defaults --
func GetDialTimeout() int { return viper.GetInt("call.dial_timeout") }
func GetMaxDuration() int { return viper.GetInt("call.max_duration") }
func GetOptimize() bool   { return viper.GetBool("call.optimize") }

// -- log --
func GetLogLevel() logrus.Level {
	level := logrus.ErrorLevel

	switch viper.GetInt("log.level") {
	case 0:
		level = logrus.PanicLevel
	case 1:
		level = logrus.FatalLevel
	case 2:
		level = logrus.ErrorLevel
	case 3:
		level = logrus.WarnLevel
	case 4:
		level = logrus.InfoLevel
	case 5:
		level = logrus.DebugLevel
	case 6:
		level = logrus.TraceLevel
	}

	return level
}

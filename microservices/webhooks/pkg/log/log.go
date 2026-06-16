package log

import (
	"github.com/sirupsen/logrus"
	"irontec.com/webhooks/pkg/config"
)

func InitLog() {
	logrus.SetLevel(
		config.GetLogLevel(),
	)
}

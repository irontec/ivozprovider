package dispatcher

import (
	"fmt"
	"strings"
)

func renderTemplate(tmpl string, event EventData, webhook webhookConfig) string {
	userIDStr := ""
	if webhook.UserID != nil {
		userIDStr = fmt.Sprintf("%d", *webhook.UserID)
	}

	r := strings.NewReplacer(
		"{{event}}", orNull(translateEvent(event.Event)),
		"{{time}}", fmt.Sprintf("%d", event.Time),
		"{{callId}}", orNull(event.CallID),
		"{{company}}", orNull(event.Company),
		"{{companyId}}", fmt.Sprintf("%d", webhook.CompanyID),
		"{{ddiId}}", orNull(event.DdiID),
		"{{crId}}", orNull(event.CrID),
		"{{dpId}}", orNull(event.DpID),
		"{{direction}}", orNull(event.Direction),
		"{{caller}}", orNull(event.Caller),
		"{{callee}}", orNull(event.Callee),
		"{{carrier}}", orNull(event.Carrier),
		"{{ddiProvider}}", orNull(event.DdiProvider),
		"{{owner}}", orNull(event.Owner),
		"{{party}}", orNull(event.Party),
		"{{userId}}", orNull(userIDStr),
		"{{iden}}", orNull(event.Iden),
	)

	return r.Replace(tmpl)
}

func orNull(s string) string {
	if s == "" {
		return "null"
	}
	return fmt.Sprintf("\"%s\"", s)
}

func translateEvent(event string) string {
	switch event {
	case "Trying":
		return "start"
	case "Early":
		return "ringing"
	case "Confirmed":
		return "answer"
	case "Terminated":
		return "end"
	case "UpdateCLID":
		return "updateClid"
	default:
		return ""
	}
}

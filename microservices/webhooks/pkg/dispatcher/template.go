package dispatcher

import (
	"fmt"
	"strings"
)

func renderTemplate(tmpl string, event EventData, webhook webhookConfig) string {
	ddiID := ""
	if webhook.DdiID != nil {
		ddiID = fmt.Sprintf("%d", *webhook.DdiID)
	}

	r := strings.NewReplacer(
		"{event}", event.Event,
		"{callId}", event.CallID,
		"{brand}", event.Brand,
		"{brandId}", fmt.Sprintf("%d", webhook.BrandID),
		"{company}", event.Company,
		"{companyId}", fmt.Sprintf("%d", webhook.CompanyID),
		"{ddiId}", ddiID,
		"{direction}", event.Direction,
		"{party}", event.Party,
		"{owner}", event.Owner,
		"{caller}", event.Caller,
		"{callee}", event.Callee,
		"{carrier}", event.Carrier,
		"{time}", fmt.Sprintf("%d", event.Time),
	)

	return r.Replace(tmpl)
}

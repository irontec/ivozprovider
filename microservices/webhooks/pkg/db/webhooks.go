package db

import (
	"database/sql"

	_ "github.com/go-sql-driver/mysql"
	logger "github.com/sirupsen/logrus"
	"irontec.com/webhooks/pkg/config"
)

type Webhook struct {
	ID            int
	Name          string
	URI           string
	EventStart    bool
	EventRing     bool
	EventAnswer   bool
	EventEnd         bool
	EventUpdateClid  bool
	Template         string
	BrandID       int
	CompanyID     int
	DdiID         *int
	UserID        *int
	CallDirection string
}

func LoadWebhooks() ([]Webhook, error) {
	conn, err := sql.Open("mysql", config.GetDatabaseDSN())
	if err != nil {
		return nil, err
	}
	defer conn.Close()

	rows, err := conn.Query(`
		SELECT w.id, w.name, w.URI, w.eventStart, w.eventRing, w.eventAnswer, w.eventEnd, w.eventUpdateClid,
		       w.template, w.brandId, w.companyId, w.ddiId, w.userId, w.callDirection
		FROM Webhooks w
		INNER JOIN Features f ON f.iden = 'webhooks'
		LEFT JOIN FeaturesRelCompanies frc ON frc.companyId = w.companyId AND frc.featureId = f.id
		LEFT JOIN FeaturesRelBrands frb ON frb.brandId = w.brandId AND frb.featureId = f.id
		WHERE w.companyId IS NOT NULL
		AND (
		  (w.userId IS NOT NULL AND frc.id IS NOT NULL)
		  OR (w.userId IS NULL AND frb.id IS NOT NULL)
		)
	`)
	if err != nil {
		return nil, err
	}
	defer rows.Close()

	var webhooks []Webhook
	for rows.Next() {
		var w Webhook
		err := rows.Scan(
			&w.ID, &w.Name, &w.URI,
			&w.EventStart, &w.EventRing, &w.EventAnswer, &w.EventEnd, &w.EventUpdateClid,
			&w.Template, &w.BrandID, &w.CompanyID, &w.DdiID, &w.UserID, &w.CallDirection,
		)
		if err != nil {
			logger.Errorf("Failed to scan webhook row: %v", err)
			continue
		}
		webhooks = append(webhooks, w)
	}

	if err := rows.Err(); err != nil {
		return nil, err
	}

	return webhooks, nil
}

func LoadWebhookByID(id int) (*Webhook, error) {
	conn, err := sql.Open("mysql", config.GetDatabaseDSN())
	if err != nil {
		return nil, err
	}
	defer conn.Close()

	var w Webhook
	err = conn.QueryRow(`
		SELECT w.id, w.name, w.URI, w.eventStart, w.eventRing, w.eventAnswer, w.eventEnd, w.eventUpdateClid,
		       w.template, w.brandId, w.companyId, w.ddiId, w.userId, w.callDirection
		FROM Webhooks w
		INNER JOIN Features f ON f.iden = 'webhooks'
		LEFT JOIN FeaturesRelCompanies frc ON frc.companyId = w.companyId AND frc.featureId = f.id
		LEFT JOIN FeaturesRelBrands frb ON frb.brandId = w.brandId AND frb.featureId = f.id
		WHERE w.id = ? AND w.companyId IS NOT NULL
		AND (
		  (w.userId IS NOT NULL AND frc.id IS NOT NULL)
		  OR (w.userId IS NULL AND frb.id IS NOT NULL)
		)
	`, id).Scan(
		&w.ID, &w.Name, &w.URI,
		&w.EventStart, &w.EventRing, &w.EventAnswer, &w.EventEnd, &w.EventUpdateClid,
		&w.Template, &w.BrandID, &w.CompanyID, &w.DdiID, &w.UserID, &w.CallDirection,
	)
	if err == sql.ErrNoRows {
		return nil, nil
	}
	if err != nil {
		return nil, err
	}
	return &w, nil
}

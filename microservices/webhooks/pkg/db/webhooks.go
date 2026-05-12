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
	EventEnd      bool
	Template      string
	BrandID       int
	CompanyID     int
	DdiID         *int
	CallDirection string
}

func LoadWebhooks() ([]Webhook, error) {
	conn, err := sql.Open("mysql", config.GetDatabaseDSN())
	if err != nil {
		return nil, err
	}
	defer conn.Close()

	rows, err := conn.Query(`
		SELECT id, name, URI, eventStart, eventRing, eventAnswer, eventEnd,
		       template, brandId, companyId, ddiId, callDirection
		FROM Webhooks
		WHERE companyId IS NOT NULL
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
			&w.EventStart, &w.EventRing, &w.EventAnswer, &w.EventEnd,
			&w.Template, &w.BrandID, &w.CompanyID, &w.DdiID, &w.CallDirection,
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
		SELECT id, name, URI, eventStart, eventRing, eventAnswer, eventEnd,
		       template, brandId, companyId, ddiId, callDirection
		FROM Webhooks
		WHERE id = ? AND companyId IS NOT NULL
	`, id).Scan(
		&w.ID, &w.Name, &w.URI,
		&w.EventStart, &w.EventRing, &w.EventAnswer, &w.EventEnd,
		&w.Template, &w.BrandID, &w.CompanyID, &w.DdiID, &w.CallDirection,
	)
	if err == sql.ErrNoRows {
		return nil, nil
	}
	if err != nil {
		return nil, err
	}
	return &w, nil
}

// Package db resolves a SIP terminal AoR (username@domain) into the data needed
// to authenticate the digest and place the call, reading directly from the
// IvozProvider MySQL database with a least-privilege account.
package db

import (
	"database/sql"
	"errors"
	"fmt"
	"time"

	_ "github.com/go-sql-driver/mysql"
)

// ErrNotEligible is returned when the AoR has no terminal+endpoint+user+extension
// (the INNER JOINs return no row), i.e. it is not eligible for click2call.
var ErrNotEligible = errors.New("aor not eligible for click2call")

// Credentials holds everything the /call handler needs about the originating terminal.
type Credentials struct {
	BrandID   int
	CompanyID int
	Password  string // plaintext SIP password, used only to recompute HA1
	SorceryID string // C2DENDPOINT
	Extension string // ORIGINATE_EXTEN / CallerID of leg 1
}

type DB struct {
	conn *sql.DB
}

func New(host string, port int, user, password, name string) (*DB, error) {
	dsn := fmt.Sprintf(
		"%s:%s@tcp(%s:%d)/%s?charset=utf8mb4&timeout=5s&readTimeout=5s",
		user, password, host, port, name,
	)

	conn, err := sql.Open("mysql", dsn)
	if err != nil {
		return nil, err
	}

	conn.SetMaxOpenConns(8)
	conn.SetConnMaxLifetime(5 * time.Minute)

	return &DB{conn: conn}, nil
}

// Terminal + endpoint + user + extension are all required (INNER JOIN); a missing
// link means the AoR is not eligible.
const credentialsQuery = `
SELECT C.brandId, C.id AS companyId, T.password, ape.sorcery_id, e.number AS extension
FROM Terminals T
JOIN Companies C          ON C.id = T.companyId
JOIN Domains D            ON D.id = C.domainId
JOIN ast_ps_endpoints ape ON T.id = ape.terminalId
JOIN Users u              ON u.terminalId = T.id
JOIN Extensions e         ON e.id = u.extensionId
WHERE D.domain = ? AND T.name = ?`

// GetCredentials runs the resolution query for the given AoR parts.
func (d *DB) GetCredentials(domain, username string) (*Credentials, error) {
	row := d.conn.QueryRow(credentialsQuery, domain, username)

	var c Credentials
	err := row.Scan(&c.BrandID, &c.CompanyID, &c.Password, &c.SorceryID, &c.Extension)
	if errors.Is(err, sql.ErrNoRows) {
		return nil, ErrNotEligible
	}
	if err != nil {
		return nil, err
	}

	return &c, nil
}

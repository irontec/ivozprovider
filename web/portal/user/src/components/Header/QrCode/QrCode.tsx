import QRCode from 'qrcode.react';
import React from 'react';

import { Status } from '../../../store/userStatus/status';

export const QrCode = (props: Status) => {
  const {
    companyDomain,
    terminalName,
    terminalPassword,
    extensionNumber,
    companyName,
    userName,
    voiceMail,
  } = props;
  const xmlData =
    `<?xml version="1.0" encoding="utf-8"?>` +
    `<AccountConfig version="1"><Account>` +
    `<RegisterServer>${companyDomain}</RegisterServer>` +
    `<UserID>${terminalName}</UserID>` +
    `<AuthID>${terminalName}</AuthID>` +
    `<AuthPass>${terminalPassword}</AuthPass>` +
    `<AccountName>${extensionNumber} ${companyName}</AccountName>` +
    `<DisplayName>${userName}</DisplayName>` +
    `<Voicemail>${voiceMail}</Voicemail>` +
    `</Account></AccountConfig>`;

  return <QRCode value={xmlData} />;
};

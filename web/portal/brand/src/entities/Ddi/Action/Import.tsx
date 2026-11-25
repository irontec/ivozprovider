import { DropdownChoices } from '@irontec/ivoz-ui';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  ActionItemProps,
  isSingleRowAction,
} from '@irontec/ivoz-ui/router/routeMapParser';
import { Autocomplete } from '@irontec/ivoz-ui/services/form/Field/Autocomplete';
import { DynamicAutocomplete } from '@irontec/ivoz-ui/services/form/Field/DynamicAutocomplete';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import UploadFileIcon from '@mui/icons-material/UploadFile';
import { Box, CircularProgress, Link, Tooltip } from '@mui/material';
import { ReactNode, useEffect, useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import FileUpload from '../../../components/FileUpload';
import Company from '../../Company/Company';
import { DdiSelectOptions } from '../../Company/SelectOptions';
import CountrySelectOptions from '../../Country/SelectOptions';
import DdiProviderSelectOptions from '../../DdiProvider/SelectOptions';
import Ddi from '../Ddi';

const FILE_LINE = 0;
const NONE = '__null__';

const TEMPLATE_ROWS = ['944048182', '944048183', '944048184'];

type ImportRow = {
  line: number;
  message: string;
};

type ImportResult = {
  created: number;
  updated: number;
  skipped: number;
  failed: number;
  updatedLines: number[];
  skippedRows: ImportRow[];
  errors: ImportRow[];
};

type CompanyCountry = {
  country: { id: number };
};

const downloadTemplate = () => {
  const blob = new Blob([`${TEMPLATE_ROWS.join('\n')}\n`], {
    type: 'text/csv;charset=utf-8',
  });
  const url = URL.createObjectURL(blob);
  const link = document.createElement('a');
  link.href = url;
  link.download = 'ddis.csv';
  link.click();
  setTimeout(() => URL.revokeObjectURL(url), 0);
};

const formatRow = (row: ImportRow) =>
  row.line === FILE_LINE
    ? _('File: {{message}}', { message: row.message })
    : _('Line {{line}}: {{message}}', {
        line: row.line,
        message: row.message,
      });

const Import: ActionFunctionComponent = (props: ActionItemProps) => {
  const { variant = 'icon' } = props;

  const apiGet = useStoreActions((actions) => actions.api.get);
  const apiPost = useStoreActions((actions) => actions.api.post);
  const reload = useStoreActions((actions) => actions.list.reload);
  const profile = useStoreState((state) => state.clientSession.aboutMe.profile);

  const [open, setOpen] = useState(false);
  const [file, setFile] = useState<File | null>(null);
  const [companyId, setCompanyId] = useState<number | null>(null);
  const [countryId, setCountryId] = useState<number | null>(null);
  const [ddiProviderId, setDdiProviderId] = useState<number | null>(null);
  const [countryChoices, setCountryChoices] = useState<DropdownChoices>([]);
  const [sending, setSending] = useState(false);
  const [result, setResult] = useState<ImportResult | null>(null);
  const [requestError, setRequestError] = useState<ReactNode>(null);

  useEffect(() => {
    if (!open) {
      return;
    }

    CountrySelectOptions({ callback: setCountryChoices });
  }, [open]);

  useEffect(() => {
    if (!companyId) {
      return;
    }

    apiGet({
      path: `${Company.path}/${companyId}`,
      params: {
        _properties: ['country'],
      },
      successCallback: async (data) => {
        setCountryId((data as CompanyCountry).country.id);
      },
    });
  }, [companyId, apiGet]);

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  const ddiAcl = profile?.acls.find((acl) => acl.iden === Ddi.acl.iden);
  const hasWritePrivileges = ddiAcl?.create === true && ddiAcl.update === true;
  const canImport = !profile?.restricted || hasWritePrivileges;
  if (!canImport) {
    return <span className='display-none'></span>;
  }

  const handleClose = () => {
    if (sending) {
      return;
    }

    const mustReload = (result?.created ?? 0) + (result?.updated ?? 0) > 0;

    setOpen(false);
    setFile(null);
    setCompanyId(null);
    setCountryId(null);
    setDdiProviderId(null);
    setResult(null);
    setRequestError(null);

    if (mustReload) {
      reload();
    }
  };

  const handleSubmit = () => {
    if (!file || !countryId) {
      return;
    }

    const formData = new FormData();
    formData.append('country', `${countryId}`);
    if (companyId) {
      formData.append('company', `${companyId}`);
    }
    if (ddiProviderId) {
      formData.append('ddiProvider', `${ddiProviderId}`);
    }
    formData.append('csv', file);

    setSending(true);
    apiPost({
      path: `${Ddi.path}/mass_import`,
      values: formData,
      contentType: 'multipart/form-data',
      silenceErrors: true,
    })
      .then((response?: { data: ImportResult }) => {
        if (!response) {
          return;
        }

        setResult(response.data);
      })
      .catch((error: { data?: { detail?: string } }) => {
        setRequestError(error?.data?.detail ?? _('Unexpected error'));
      })
      .finally(() => {
        setSending(false);
      });
  };

  const toOptionalId = (value: unknown): number | null => {
    const isSelected = value !== NONE && value !== '';

    return isSelected ? Number(value) : null;
  };

  const canSend = file !== null && countryId !== null && !sending;

  const fileButtons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
      autoFocus: false,
      disabled: sending,
    },
    {
      label: _('Send'),
      onClick: handleSubmit,
      variant: 'solid' as const,
      autoFocus: true,
      disabled: !canSend,
    },
  ];

  const resultButtons = [
    {
      label: _('Close'),
      onClick: handleClose,
      variant: 'solid' as const,
      autoFocus: true,
    },
  ];

  const showResult = result !== null || requestError !== null;

  return (
    <>
      <a onClick={() => setOpen(true)}>
        {variant === 'text' && <MoreMenuItem>{_('Import DDIs')}</MoreMenuItem>}
        {variant === 'icon' && (
          <Tooltip
            title={_('Import DDIs')}
            placement='bottom-start'
            enterTouchDelay={0}
          >
            <StyledTableRowCustomCta>
              <UploadFileIcon color='primary' />
            </StyledTableRowCustomCta>
          </Tooltip>
        )}
      </a>
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Import DDIs')}
          buttons={showResult ? resultButtons : fileButtons}
        >
          {!showResult && (
            <Box sx={{ textAlign: 'left' }}>
              <p>
                {_(
                  'CSV file with one DDI number per row, without country prefix and without header row. Empty rows are ignored.'
                )}{' '}
                <Link component='button' onClick={downloadTemplate}>
                  {_('Download template')}
                </Link>
              </p>
              <p>
                {_(
                  'Every row is imported with the selected country, client and DDI provider. New DDIs are created as inout, without route. Existing DDIs of the brand without client or without DDI provider get the selected ones; the rest are skipped without changes.'
                )}
              </p>
              <DynamicAutocomplete
                name='company'
                label={_('Client')}
                nullOption={_('Unassigned')}
                value={companyId ?? NONE}
                choices={[]}
                selectOptions={DdiSelectOptions}
                multiple={false}
                required={false}
                disabled={sending}
                hasChanged={false}
                onChange={(event) => {
                  setCompanyId(toOptionalId(event.target.value));
                }}
                onBlur={() => {
                  return;
                }}
              />
              <Autocomplete
                name='country'
                label={_('Country', { count: 1 })}
                value={countryId ?? ''}
                choices={countryChoices}
                multiple={false}
                required={true}
                disabled={sending}
                hasChanged={false}
                helperText={_(
                  'Preselected from the client, it can be changed.'
                )}
                onChange={(event) => {
                  const { value } = event.target;
                  setCountryId(value ? Number(value) : null);
                }}
                onBlur={() => {
                  return;
                }}
              />
              <DynamicAutocomplete
                name='ddiProvider'
                label={_('DDI provider')}
                nullOption={_('None')}
                value={ddiProviderId ?? NONE}
                choices={[]}
                selectOptions={DdiProviderSelectOptions}
                multiple={false}
                required={false}
                disabled={sending}
                hasChanged={false}
                onChange={(event) => {
                  setDdiProviderId(toOptionalId(event.target.value));
                }}
                onBlur={() => {
                  return;
                }}
              />
              <FileUpload onFileSelect={setFile} accept='.csv,text/csv' />
              {sending && (
                <Box sx={{ textAlign: 'center', marginTop: 2 }}>
                  <CircularProgress size={28} />
                  <p>{_('Importing, please wait')}</p>
                </Box>
              )}
            </Box>
          )}
          {requestError !== null && (
            <Box sx={{ textAlign: 'left' }}>
              <p>{requestError}</p>
            </Box>
          )}
          {result !== null && (
            <Box sx={{ textAlign: 'left' }}>
              <p>
                {_('Created')}: {result.created}
              </p>
              <p>
                {_('Updated')}: {result.updated}
              </p>
              <p>
                {_('Skipped')}: {result.skipped}
              </p>
              <p>
                {_('Failed')}: {result.failed}
              </p>
              {result.updatedLines.length > 0 && (
                <p>
                  {_('Updated lines: {{lines}}', {
                    lines: result.updatedLines.join(', '),
                  })}
                </p>
              )}
              {result.skippedRows.length > 0 && (
                <>
                  <p>{_('Skipped')}:</p>
                  <ul>
                    {result.skippedRows.map((row) => (
                      <li key={`skipped-${row.line}`}>{formatRow(row)}</li>
                    ))}
                  </ul>
                </>
              )}
              {result.errors.length > 0 && (
                <>
                  <p>{_('Failed')}:</p>
                  <ul>
                    {result.errors.map((row) => (
                      <li key={`error-${row.line}`}>{formatRow(row)}</li>
                    ))}
                  </ul>
                </>
              )}
            </Box>
          )}
        </Modal>
      )}
    </>
  );
};

export default Import;

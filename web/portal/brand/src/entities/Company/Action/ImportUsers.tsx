import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import UploadFileIcon from '@mui/icons-material/UploadFile';
import { Box, CircularProgress, Link, Tooltip } from '@mui/material';
import { ReactNode, useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import FileUpload from '../../../components/FileUpload';

const MASS_IMPORT_PATH = '/users/mass_import';
const MASS_IMPORT_ACL = '_UsersMassImport';

const TEMPLATE_HEADER =
  'name,lastname,email,terminal name,terminal password,terminal model,mac,extension,ddi country,ddi number,ddi provider';
const TEMPLATE_ROWS = [
  TEMPLATE_HEADER,
  'Alice,Allison,alice@example.com,alice_t21,Zx9*abc123DEF,YealinkT21P_E2,001565aabbcc,301,ES,944000301,',
  'Bob,Bobson,bob@example.com,bob_t21,,YealinkT21P_E2,,302,,,',
  'Carol,Smith,carol@example.com,,,,,,,,',
];

type ImportError = {
  line: number;
  message: string;
};

type ImportResult = {
  created: number;
  updated: number;
  errors: ImportError[];
};

const downloadTemplate = () => {
  const blob = new Blob([`${TEMPLATE_ROWS.join('\n')}\n`], {
    type: 'text/csv;charset=utf-8',
  });
  const url = URL.createObjectURL(blob);
  const link = document.createElement('a');
  link.href = url;
  link.download = 'vpbx-users.csv';
  link.click();
  setTimeout(() => URL.revokeObjectURL(url), 0);
};

const ImportUsers: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon' } = props;

  const apiPost = useStoreActions((actions) => actions.api.post);
  const reload = useStoreActions((actions) => actions.list.reload);
  const profile = useStoreState((state) => state.clientSession.aboutMe.profile);

  const [open, setOpen] = useState(false);
  const [file, setFile] = useState<File | null>(null);
  const [sending, setSending] = useState(false);
  const [result, setResult] = useState<ImportResult | null>(null);
  const [requestError, setRequestError] = useState<ReactNode>(null);

  if (!row) {
    return null;
  }

  const importAcl = profile?.acls.find((acl) => acl.iden === MASS_IMPORT_ACL);
  const canImport = !profile?.restricted || importAcl?.create === true;
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
    setResult(null);
    setRequestError(null);

    if (mustReload) {
      reload();
    }
  };

  const handleSubmit = () => {
    if (!file) {
      return;
    }

    const formData = new FormData();
    formData.append('company', `${row.id}`);
    formData.append('csv', file);

    setSending(true);
    apiPost({
      path: MASS_IMPORT_PATH,
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
      disabled: file === null || sending,
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
        {variant === 'text' && <MoreMenuItem>{_('Import users')}</MoreMenuItem>}
        {variant === 'icon' && (
          <Tooltip
            title={_('Import users')}
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
          title={_('Import users')}
          buttons={showResult ? resultButtons : fileButtons}
        >
          {!showResult && (
            <Box sx={{ textAlign: 'left' }}>
              <p>
                {_(
                  'CSV file with one user per row and the following columns, in this order. Fields with * are required.'
                )}
              </p>
              <ol>
                <li>{_('Name*')}</li>
                <li>{_('Lastname*')}</li>
                <li>{_('Email')}</li>
                <li>{_('Terminal name')}</li>
                <li>{_('Terminal password (empty keeps or generates one)')}</li>
                <li>{_('Terminal model')}</li>
                <li>{_('MAC')}</li>
                <li>{_('Extension')}</li>
                <li>{_('DDI country')}</li>
                <li>{_('DDI number')}</li>
                <li>{_('DDI provider')}</li>
              </ol>
              <p>
                {_(
                  'Existing users are matched by name and lastname; empty columns leave their current values untouched.'
                )}{' '}
                <Link component='button' onClick={downloadTemplate}>
                  {_('Download template')}
                </Link>
              </p>
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
                {_('Failed')}: {result.errors.length}
              </p>
              {result.errors.length > 0 && (
                <ul>
                  {result.errors.map((error) => (
                    <li key={`line-${error.line}`}>
                      {error.line === 0
                        ? _('File: {{message}}', { message: error.message })
                        : _('Line {{line}}: {{message}}', {
                            line: error.line,
                            message: error.message,
                          })}
                    </li>
                  ))}
                </ul>
              )}
            </Box>
          )}
        </Modal>
      )}
    </>
  );
};

export default ImportUsers;

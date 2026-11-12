import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  ActionItemProps,
  isSingleRowAction,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import UploadFileIcon from '@mui/icons-material/UploadFile';
import { Box, CircularProgress, Link, Tooltip } from '@mui/material';
import { ReactNode, useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import FileUpload from '../../../components/FileUpload';
import { AboutMe } from '../../../store/clientSession/aboutMe';
import Contact from '../Contact';

const FILE_LINE = 0;

const TEMPLATE_ROWS = [
  'id,name,lastname,email,workPhoneCountry,workPhone,mobilePhoneCountry,mobilePhone,otherPhone',
  ',Ana,García,ana@example.com,ES,944048182,ES,600000000,',
  ',Juan,Pérez,,,,,,Fax 2010',
  ',Marta,López,,,944000111,,,',
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

const canImportContacts = (profile: AboutMe | null): boolean => {
  if (!profile) {
    return false;
  }

  if (!profile.restricted) {
    return true;
  }

  const acl = profile.acls.find((item) => item.iden === Contact.acl.iden);

  return acl?.create === true && acl.update === true;
};

const downloadTemplate = () => {
  const blob = new Blob([`${TEMPLATE_ROWS.join('\n')}\n`], {
    type: 'text/csv;charset=utf-8',
  });
  const url = URL.createObjectURL(blob);
  const link = document.createElement('a');
  link.href = url;
  link.download = 'contacts.csv';
  link.click();
  setTimeout(() => URL.revokeObjectURL(url), 0);
};

const Import: ActionFunctionComponent = (props: ActionItemProps) => {
  const { variant = 'icon' } = props;

  const apiPost = useStoreActions((actions) => actions.api.post);
  const reload = useStoreActions((actions) => actions.list.reload);
  const profile = useStoreState((state) => state.clientSession.aboutMe.profile);

  const [open, setOpen] = useState(false);
  const [file, setFile] = useState<File | null>(null);
  const [sending, setSending] = useState(false);
  const [result, setResult] = useState<ImportResult | null>(null);
  const [requestError, setRequestError] = useState<ReactNode>(null);

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  if (!canImportContacts(profile)) {
    return <span className='display-none'></span>;
  }

  const handleClose = () => {
    if (sending) {
      return;
    }

    const mustReload = result !== null;

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
    formData.append('csv', file);

    setSending(true);
    apiPost({
      path: `${Contact.path}/mass_import`,
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
        {variant === 'text' && (
          <MoreMenuItem>{_('Import contacts')}</MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={_('Import contacts')}
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
          title={_('Import contacts')}
          buttons={showResult ? resultButtons : fileButtons}
        >
          {!showResult && (
            <Box sx={{ textAlign: 'left' }}>
              <p>
                {_(
                  'UTF-8 CSV file, comma or semicolon separated, with a header row and one contact per row. Allowed columns:'
                )}
              </p>
              <ul>
                <li>
                  {_('id: empty to create a contact, filled to update it')}
                </li>
                <li>{_('name: required to create a contact')}</li>
                <li>lastname, email, otherPhone</li>
                <li>
                  {_(
                    'workPhoneCountry, workPhone, mobilePhoneCountry, mobilePhone: ISO country code (ES) and number without prefix. Without country, the client country is used.'
                  )}
                </li>
              </ul>
              <p>
                {_(
                  'An empty column deletes its value and a column missing from the header is left untouched. Contacts linked to a user only update their phones.'
                )}{' '}
                <Link component='button' onClick={downloadTemplate}>
                  {_('Download template')}
                </Link>
              </p>
              <FileUpload onFileSelect={setFile} />
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
          {result !== null && <ImportResultSummary result={result} />}
        </Modal>
      )}
    </>
  );
};

const ImportResultSummary = ({ result }: { result: ImportResult }) => {
  const rejected = result.errors.filter(
    (error) => error.line !== FILE_LINE
  ).length;

  return (
    <Box sx={{ textAlign: 'left' }}>
      <p>
        {_('Created')}: {result.created}
      </p>
      <p>
        {_('Updated')}: {result.updated}
      </p>
      <p>
        {_('Rejected')}: {rejected}
      </p>
      {result.errors.length > 0 && (
        <ul>
          {result.errors.map((error) => (
            <li key={`line-${error.line}`}>
              {error.line === FILE_LINE
                ? _('File: {{message}}', { message: error.message })
                : _('Line {{line}}: {{message}}', {
                    line: error.line,
                    message: error.message,
                  })}
            </li>
          ))}
        </ul>
      )}
      {rejected > 0 && (
        <p>
          {_(
            'Fix and import only the failed lines: importing the whole file again would duplicate the contacts created from rows without id.'
          )}
        </p>
      )}
    </Box>
  );
};

export default Import;

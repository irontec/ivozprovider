import DialogContentBody from '@irontec/ivoz-ui/components/Dialog/DialogContentBody';
import ErrorMessageComponent from '@irontec/ivoz-ui/components/ErrorMessageComponent';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  ActionItemProps,
  isSingleRowAction,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CloudDownloadIcon from '@mui/icons-material/CloudDownload';
import { Tooltip } from '@mui/material';
import CircularProgress from '@mui/material/CircularProgress';
import { useState } from 'react';
import { useStoreActions } from 'store';

import Contact from '../Contact';

const Export: ActionFunctionComponent = (props: ActionItemProps) => {
  const { variant = 'icon' } = props;

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);
  const [errorMsg, setErrorMsg] = useState<string>('');

  const apiDownload = useStoreActions((actions) => actions.api.download);

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  const handleClickOpen = () => {
    setOpen(true);
    const search = location.search;
    const glue = search.includes('?') ? '&' : '?';

    apiDownload({
      path: `${Contact.path + search + glue}_pagination=false`,
      params: {},
      headers: {
        accept: 'text/csv',
      },
      successCallback: async (data) => {
        const blobUrl = URL.createObjectURL(data as Blob);
        const link = document.createElement('a');
        link.href = blobUrl;
        link.download = 'contacts.csv';

        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(blobUrl);

        setOpen(false);
        setError(false);
      },
    }).catch((error: { statusText: string; status: number }) => {
      setErrorMsg(`${error.statusText} (${error.status})`);
      setError(true);
    });
  };

  const handleClose = () => {
    setOpen(false);
    setError(false);
  };

  const customButtons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
    },
  ];

  return (
    <>
      <a onClick={handleClickOpen}>
        {variant === 'text' && (
          <MoreMenuItem>{_('Export contacts')}</MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={_('Export contacts')}
            placement='bottom-start'
            enterTouchDelay={0}
          >
            <StyledTableRowCustomCta>
              <CloudDownloadIcon color='primary' />
            </StyledTableRowCustomCta>
          </Tooltip>
        )}
      </a>
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Downloading')}
          buttons={customButtons}
        >
          {!error && <DialogContentBody child={<CircularProgress />} />}
          {error && <ErrorMessageComponent message={errorMsg} />}
        </Modal>
      )}
    </>
  );
};

export default Export;

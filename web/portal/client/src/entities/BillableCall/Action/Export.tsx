import DialogContentBody from '@irontec/ivoz-ui/components/Dialog/DialogContentBody';
import ErrorMessageComponent from '@irontec/ivoz-ui/components/ErrorMessageComponent';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  isSingleRowAction,
  MultiSelectActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CloudDownloadIcon from '@mui/icons-material/CloudDownload';
import { Tooltip } from '@mui/material';
import CircularProgress from '@mui/material/CircularProgress';
import { useState } from 'react';
import { useStoreActions } from 'store';

import BillableCall from '../BillableCall';

const Export: ActionFunctionComponent = (props: MultiSelectActionItemProps) => {
  const { variant = 'icon' } = props;

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);
  const [errorMsg, setErrorMsg] = useState<string>('');

  const apiDownload = useStoreActions((actions) => actions.api.download);

  const handleClickOpen = () => {
    setOpen(true);
    const search = location.search;
    const glue = search.includes('?') ? '&' : '?';

    apiDownload({
      path: `${BillableCall.path + search + glue}_pagination=false`,
      params: {},
      headers: {
        accept: 'text/csv',
      },
      successCallback: async (data) => {
        const blobUrl = URL.createObjectURL(data as Blob);
        const link = document.createElement('a');
        link.href = blobUrl;
        link.download = 'external calls.csv';

        // Append link to the body
        document.body.appendChild(link);
        link.dispatchEvent(
          new MouseEvent('click', {
            bubbles: true,
            cancelable: true,
            view: window,
          })
        );

        // Remove link from body
        document.body.removeChild(link);
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

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  const customButtons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
      autoFocus: false,
    },
  ];

  return (
    <>
      <a onClick={handleClickOpen}>
        {variant === 'text' && (
          <MoreMenuItem>{_('Export to CSV')}</MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={_('Export to CSV')}
            placement='bottom'
            enterTouchDelay={0}
          >
            <span>
              <StyledTableRowCustomCta>
                <CloudDownloadIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </a>
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Downloading')}
          buttons={customButtons}
          keepMounted={true}
        >
          {!error && <DialogContentBody child={<CircularProgress />} />}
          {error && <ErrorMessageComponent message={errorMsg} />}
        </Modal>
      )}
    </>
  );
};

export default Export;

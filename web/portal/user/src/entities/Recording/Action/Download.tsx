import DialogContentBody from '@irontec/ivoz-ui/components/Dialog/DialogContentBody';
import ErrorMessageComponent from '@irontec/ivoz-ui/components/ErrorMessageComponent';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import { OutlinedButton } from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import {
  ActionFunctionComponent,
  isSingleRowAction,
  MultiSelectActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CloudDownloadIcon from '@mui/icons-material/CloudDownload';
import {
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
  Tooltip,
} from '@mui/material';
import CircularProgress from '@mui/material/CircularProgress';
import { useState } from 'react';

import { useStoreActions } from '../../../store';
import Recording from '../Recording';

const Download: ActionFunctionComponent = (
  props: MultiSelectActionItemProps
) => {
  const { variant = 'icon', selectedValues } = props;

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);
  const [errorMsg, setErrorMsg] = useState<string>('');

  const apiDownload = useStoreActions((actions) => actions.api.download);

  const handleClickOpen = () => {
    setOpen(true);
    const recordingIds = selectedValues.join(',');

    apiDownload({
      path: `${Recording.path}/recorded_files_zip?_recordingIds=${recordingIds}`,
      params: {},
      headers: {
        accept: 'text/csv',
      },
      successCallback: async (data) => {
        const blobUrl = URL.createObjectURL(data as Blob);
        const link = document.createElement('a');
        link.href = blobUrl;
        link.download = 'recordings.zip';

        document.body.appendChild(link);
        link.dispatchEvent(
          new MouseEvent('click', {
            bubbles: true,
            cancelable: true,
            view: window,
          })
        );

        document.body.removeChild(link);
        setOpen(false);
        setError(false);
      },
      handleErrors: false,
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

  return (
    <>
      <a onClick={handleClickOpen}>
        {variant === 'text' && <MoreMenuItem>{_('Download')}</MoreMenuItem>}
        {variant === 'icon' && (
          <Tooltip title={_('Download')} placement='bottom' enterTouchDelay={0}>
            <span>
              <StyledTableRowCustomCta>
                <CloudDownloadIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </a>
      {open && (
        <Dialog open={open} onClose={handleClose} keepMounted>
          <DialogTitle>Downloading</DialogTitle>
          <DialogContent sx={{ textAlign: 'left!important' }}>
            {!error && <DialogContentBody child={<CircularProgress />} />}
            {error && <ErrorMessageComponent message={errorMsg} />}
          </DialogContent>
          <DialogActions>
            <OutlinedButton onClick={handleClose}>Cancel</OutlinedButton>
          </DialogActions>
        </Dialog>
      )}
    </>
  );
};

export default Download;

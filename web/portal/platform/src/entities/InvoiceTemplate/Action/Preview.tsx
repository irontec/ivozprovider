import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import { OutlinedButton } from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import {
  ActionFunctionComponent,
  ActionItemProps,
  isSingleRowAction,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ErrorIcon from '@mui/icons-material/Error';
import PreviewIcon from '@mui/icons-material/Preview';
import {
  Box,
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
  Tooltip,
} from '@mui/material';
import CircularProgress from '@mui/material/CircularProgress';
import { useState } from 'react';
import { useStoreActions } from 'store';

import InvoiceTemplate from '../InvoiceTemplate';

const Preview: ActionFunctionComponent = (props: ActionItemProps) => {
  const { variant = 'icon', row } = props;

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);
  const [errorMsg, setErrorMsg] = useState<string>('');

  const apiDownload = useStoreActions((actions) => actions.api.download);

  const handleClickOpen = () => {
    setOpen(true);

    apiDownload({
      path: `${InvoiceTemplate.path}/${row.id}/preview`,
      params: {},
      headers: {
        accept: 'application/pdf',
      },
      successCallback: async (data, headers) => {
        const fileName = (headers['content-disposition'] || '')
          .split('filename=')
          .pop();

        const blobUrl = URL.createObjectURL(data as Blob);
        const link = document.createElement('a');
        link.href = blobUrl;
        link.download = fileName || 'invoice template preview.pdf';

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

  if (!isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  return (
    <>
      <a onClick={handleClickOpen}>
        {variant === 'text' && <MoreMenuItem>{_('Preview')}</MoreMenuItem>}
        {variant === 'icon' && (
          <Tooltip title={_('Preview')} placement='bottom' enterTouchDelay={0}>
            <span>
              <StyledTableRowCustomCta>
                <PreviewIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </a>
      {open && (
        <Dialog open={open} onClose={handleClose} keepMounted>
          <DialogTitle>{_('Downloading')}</DialogTitle>
          <DialogContent sx={{ textAlign: 'left!important' }}>
            {!error && (
              <Box
                sx={{
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                }}
              >
                <CircularProgress />
              </Box>
            )}
            {error && (
              <span>
                <ErrorIcon
                  sx={{
                    verticalAlign: 'bottom',
                  }}
                />
                {errorMsg ?? 'There was a problem'}
              </span>
            )}
          </DialogContent>
          <DialogActions>
            <OutlinedButton onClick={handleClose}>{_('Cancel')}</OutlinedButton>
          </DialogActions>
        </Dialog>
      )}
    </>
  );
};

export default Preview;

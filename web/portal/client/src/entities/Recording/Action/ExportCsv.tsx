import DialogContentBody from '@irontec/ivoz-ui/components/Dialog/DialogContentBody';
import ErrorMessageComponent from '@irontec/ivoz-ui/components/ErrorMessageComponent';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import useCurrentPathMatch from '@irontec/ivoz-ui/hooks/useCurrentPathMatch';
import findRoute from '@irontec/ivoz-ui/router/findRoute';
import {
  ActionFunctionComponent,
  ActionItemProps,
  isSingleRowAction,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FileDownloadIcon from '@mui/icons-material/FileDownload';
import { Tooltip } from '@mui/material';
import CircularProgress from '@mui/material/CircularProgress';
import { useState } from 'react';
import { useParams } from 'react-router-dom';
import { useStoreActions } from 'store';

import getEntityMap from '../../../router/EntityMap';
import Recording from '../Recording';

const ExportCsv: ActionFunctionComponent = (props: ActionItemProps) => {
  const { variant = 'icon' } = props;

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);
  const [errorMsg, setErrorMsg] = useState<string>('');

  const apiDownload = useStoreActions((actions) => actions.api.download);
  const match = useCurrentPathMatch();
  const params = useParams();
  const currentRoute = findRoute(getEntityMap(), match);

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  const handleClickOpen = () => {
    setOpen(true);

    const parentFilter = currentRoute?.filterBy
      ? `${currentRoute.filterBy}[]=${Object.values(params).pop()}`
      : '';
    const query = [
      location.search.replace(/^\?/, ''),
      parentFilter,
      '_pagination=false',
    ]
      .filter(Boolean)
      .join('&');

    apiDownload({
      path: `${Recording.path}?${query}`,
      params: {},
      headers: {
        accept: 'text/csv',
      },
      successCallback: async (data) => {
        const blobUrl = URL.createObjectURL(data as Blob);
        const link = document.createElement('a');
        link.href = blobUrl;
        link.download = 'recordings.csv';

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
                <FileDownloadIcon />
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
        >
          {!error && <DialogContentBody child={<CircularProgress />} />}
          {error && <ErrorMessageComponent message={errorMsg} />}
        </Modal>
      )}
    </>
  );
};

export default ExportCsv;

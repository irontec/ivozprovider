import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CloudDownloadIcon from '@mui/icons-material/CloudDownload';
import { Box, CircularProgress, Tooltip } from '@mui/material';
import { useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import { MASS_IMPORT_ACL } from './ImportUsers';

const MASS_EXPORT_PATH = '/users/mass_export';

const ExportUsers: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon' } = props;

  const apiDownload = useStoreActions((actions) => actions.api.download);
  const profile = useStoreState((state) => state.clientSession.aboutMe.profile);

  const [open, setOpen] = useState(false);
  const [downloading, setDownloading] = useState(false);
  const [requestError, setRequestError] = useState<string | null>(null);

  if (!row) {
    return null;
  }

  const exportAcl = profile?.acls.find((acl) => acl.iden === MASS_IMPORT_ACL);
  const canExport = !profile?.restricted || exportAcl?.read === true;
  if (!canExport) {
    return <span className='display-none'></span>;
  }

  const handleClose = () => {
    setOpen(false);
    setDownloading(false);
    setRequestError(null);
  };

  const handleExport = () => {
    setDownloading(true);
    setRequestError(null);

    apiDownload({
      path: `${MASS_EXPORT_PATH}?company=${row.id}`,
      params: {},
      headers: {
        accept: 'text/csv',
      },
      successCallback: async (data) => {
        const blobUrl = URL.createObjectURL(data as Blob);
        const link = document.createElement('a');
        link.href = blobUrl;
        link.download = `${row.name}-users.csv`;

        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(blobUrl);

        handleClose();
      },
    })
      .catch((error: { statusText: string; status: number }) => {
        setRequestError(`${error.statusText} (${error.status})`);
      })
      .finally(() => {
        setDownloading(false);
      });
  };

  const buttons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
    },
    {
      label: _('Export'),
      onClick: handleExport,
      variant: 'solid' as const,
      disabled: downloading,
    },
  ];

  return (
    <>
      <a onClick={() => setOpen(true)}>
        {variant === 'text' && <MoreMenuItem>{_('Export users')}</MoreMenuItem>}
        {variant === 'icon' && (
          <Tooltip
            title={_('Export users')}
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
          title={_('Export users')}
          buttons={buttons}
        >
          <Box sx={{ textAlign: 'left' }}>
            <p>
              {_(
                'CSV file with the users of the client and their terminals, extensions and outgoing DDIs, in the format of the users import, so it can be edited and imported again.'
              )}
            </p>
            <p>
              {_(
                'Terminal passwords are not exported: importing the file keeps the current ones and generates new ones for new terminals.'
              )}
            </p>
            <p>
              {_(
                'It is not a copy of the client: user settings, inbound routes and anything not linked to a user are not included.'
              )}
            </p>
            {downloading && (
              <Box sx={{ textAlign: 'center', marginTop: 2 }}>
                <CircularProgress size={28} />
                <p>{_('Exporting, please wait')}</p>
              </Box>
            )}
            {requestError !== null && <p>{requestError}</p>}
          </Box>
        </Modal>
      )}
    </>
  );
};

export default ExportUsers;

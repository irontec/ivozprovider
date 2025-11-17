import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  MultiSelectActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CloudUploadIcon from '@mui/icons-material/CloudUpload';
import { Dialog, Tooltip } from '@mui/material';
import { styled } from '@mui/styles';
import { useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import FileUpload from '../../../components/FileUpload';
import Extension from '../Extension';

export const StyledDialog = styled(Dialog)(() => {
  return {
    '& .MuiPaper-root': {
      maxWidth: '90%',
    },
    '&.width .MuiPaper-root': {
      width: '90%',
    },
  };
});

const fileToBlob = (file: File): Blob => {
  return file.slice(0, file.size, file.type);
};

const Import: ActionFunctionComponent = (props: MultiSelectActionItemProps) => {
  const { variant = 'icon' } = props;
  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });
  const [open, setOpen] = useState(false);
  const [csv, setCsv] = useState<Blob | null>(null);
  const apiPost = useStoreActions((actions) => actions.api.post);
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const isVpbx = aboutMe?.vpbx;

  const handleClickOpen = async () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  const handleSubmit = () => {
    const formData = new FormData();

    if (csv) {
      formData.append('csv', csv);
    }

    apiPost({
      path: `${Extension.path}/mass_import`,
      values: formData,
      contentType: 'multipart/form-data',
    }).then(() => {
      setOpen(false);
      reload();
    });
  };

  const handleFileSelect = (file: File) => {
    setCsv(fileToBlob(file));
  };

  if (!isVpbx) {
    return <span className='display-none'></span>;
  }

  const customButtons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
      autoFocus: false,
    },
    {
      label: _('Send'),
      onClick: handleSubmit,
      variant: 'solid' as const,
      autoFocus: true,
    },
  ];

  return (
    <>
      <a onClick={handleClickOpen}>
        {variant === 'text' && <MoreMenuItem>{_('Import CSV')}</MoreMenuItem>}
        {variant === 'icon' && (
          <Tooltip
            title={_('Import CSV')}
            placement='bottom'
            enterTouchDelay={0}
          >
            <span>
              <StyledTableRowCustomCta>
                <CloudUploadIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </a>
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Import Extensions')}
          buttons={customButtons}
          keepMounted={true}
        >
          <FileUpload onFileSelect={handleFileSelect} />
        </Modal>
      )}
    </>
  );
};

export default Import;

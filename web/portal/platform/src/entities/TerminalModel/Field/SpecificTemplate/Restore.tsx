import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import useCurrentPathMatch from '@irontec/ivoz-ui/hooks/useCurrentPathMatch';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ErrorIcon from '@mui/icons-material/Error';
import RestorePageIcon from '@mui/icons-material/RestorePage';
import { CircularProgress } from '@mui/material';
import { useState } from 'react';
import { useStoreActions } from 'store';

import TerminalModel from '../../TerminalModel';
import {
  StyledErrorContainer,
  StyledTemplateAction,
} from '../TemplateAction.styles';
import { PropsType } from './SpecificTemplate';

const Restore = (props: PropsType): JSX.Element => {
  const { formik } = props;

  const apiGet = useStoreActions((store) => store.api.get);
  const match = useCurrentPathMatch();

  const [open, setOpen] = useState(false);
  const [errorMsg, setErrorMsg] = useState('');
  const [restoring, setRestoring] = useState(false);

  const handleOpen = () => setOpen(true);
  const handleClose = () => {
    setOpen(false);
    setErrorMsg('');
  };

  const handleRestore = () => {
    setRestoring(true);
    setErrorMsg('');

    apiGet({
      path: `${TerminalModel.path}/${match.params.id}/default_template?type=specific`,
      params: {},
      handleErrors: false,
      successCallback: async (response) => {
        formik?.setFieldValue('specificTemplate', response);
        handleClose();
      },
    })
      .catch((error: { data: { detail?: string; title: string } }) => {
        setErrorMsg(error.data.detail || error.data.title);
      })
      .finally(() => {
        setRestoring(false);
      });
  };

  const customButtons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined',
      autoFocus: false,
    },
    {
      label: _('Restore'),
      onClick: handleRestore,
      variant: 'solid',
      autoFocus: true,
    },
  ];

  return (
    <>
      <StyledTemplateAction onClick={handleOpen}>
        <RestorePageIcon /> {_('Restore default template')}
      </StyledTemplateAction>
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Restore default template?')}
          buttons={customButtons}
          keepMounted={true}
        >
          {!errorMsg && <>{restoring && <CircularProgress />}</>}
          {errorMsg && (
            <StyledErrorContainer>
              <ErrorIcon />
              {errorMsg ?? 'There was a problem'}
            </StyledErrorContainer>
          )}
        </Modal>
      )}
    </>
  );
};

export default Restore;

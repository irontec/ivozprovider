import { Tooltip } from "@mui/material";
import ConfirmDialog from "lib/components/shared/ConfirmDialog";
import EntityService from "lib/services/entity/EntityService";
import { useState } from "react";
import { useHistory } from "react-router-dom";
import { useStoreActions } from "store";
import { StyledDeleteIcon } from "../Table/ContentTableRow/ContentTableRow.styles";
import _ from 'lib/services/translations/translate';

interface DeleteRowButtonProps {
    row: any,
    entityService: EntityService
}

const DeleteRowButton = (props: DeleteRowButtonProps): JSX.Element => {

    const { row, entityService } = props;
    const [showDelete, setShowDelete] = useState<boolean>(false);
    const handleHideDelete = (): void => {
      setShowDelete(false);
    };
    const history = useHistory();
    const apiDelete = useStoreActions((actions: any) => {
      return actions.api.delete
    });

    const handleDelete = async (event: any): Promise<void> => {

      const path = entityService.getDeletePath();
      if (!path) {
        throw new Error('Unknown delete path');
      }

      event.preventDefault();
      try {
        const resp = await apiDelete({
          path: path.replace('{id}', row.id)
        });

        if (resp !== undefined) {
          history.replace(`${location.pathname}/__reloading`);
          setTimeout(() => {
            history.replace(location.pathname);
          });
        }
      } catch (error: unknown) {
        setShowDelete(false);
      }
    };

    return (
      <>
        <Tooltip title={_('Delete')} placement="bottom">
          <StyledDeleteIcon onClick={() => setShowDelete(true)} />
        </Tooltip>
        <ConfirmDialog
          text={`You're about to remove item #${row.id}`}
          open={showDelete}
          handleClose={handleHideDelete}
          handleApply={handleDelete}
        />
      </>
    );
  }

  export default DeleteRowButton;
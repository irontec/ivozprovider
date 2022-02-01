import { Tooltip } from "@mui/material";
import { StyledTableRowLink } from "../Table/ContentTableRow/ContentTableRow.styles";
import _ from 'lib/services/translations/translate';
import EditIcon from '@mui/icons-material/Edit';

interface EditRowButtonProps {
    row: Record<string, any>,
    path: string
}

const EditRowButton = (props: EditRowButtonProps): JSX.Element => {

    const { row, path } = props;

    return (
      <Tooltip title={_('Edit')} placement="bottom">
        <StyledTableRowLink to={`${path}/${row.id}/update`}>
          <EditIcon />
        </StyledTableRowLink>
      </Tooltip>
    );
  }

  export default EditRowButton;
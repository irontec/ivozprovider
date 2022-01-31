import { Tooltip } from "@mui/material";
import { StyledTableRowLink } from "../Table/ContentTableRow/ContentTableRow.styles";
import _ from 'lib/services/translations/translate';
import PanoramaIcon from '@mui/icons-material/Panorama';

interface EditRowButtonProps {
    row: Record<string, any>,
    path: string
}

const ViewRowButton = (props: EditRowButtonProps): JSX.Element => {

    const { row, path } = props;

    return (
      <Tooltip title={_('View')} placement="bottom">
        <StyledTableRowLink to={`${path}/${row.id}/detailed`}>
          <PanoramaIcon />
        </StyledTableRowLink>
      </Tooltip>
    );
  }

  export default ViewRowButton;
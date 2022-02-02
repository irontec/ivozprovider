import { Tooltip } from "@mui/material";
import { StyledTableRowLink } from "../Table/ContentTable.styles";
import _ from 'lib/services/translations/translate';
import PanoramaIcon from '@mui/icons-material/Panorama';
import { RouteComponentProps, withRouter } from "react-router-dom";
import buildLink from "../Shared/BuildLink";

type EditRowButtonProps = RouteComponentProps & {
    row: Record<string, any>,
    path: string
}

const ViewRowButton = (props: EditRowButtonProps): JSX.Element => {

    const { row, match } = props;
    const link = buildLink(match.path, match);

    return (
      <Tooltip title={_('View')} placement="bottom">
        <StyledTableRowLink to={`${link}/${row.id}/detailed`}>
          <PanoramaIcon />
        </StyledTableRowLink>
      </Tooltip>
    );
  }

  export default withRouter(ViewRowButton);
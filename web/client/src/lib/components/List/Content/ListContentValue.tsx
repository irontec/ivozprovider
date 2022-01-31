import { Fade, LinearProgress } from "@mui/material";
import { FkProperty, PropertySpec, ScalarProperty } from "lib/services/api/ParsedApiSpecInterface";
import EntityService from "lib/services/entity/EntityService";
import { StyledCheckBoxIcon, StyledCheckBoxOutlineBlankIcon, StyledTableRowFkLink } from "./Table/ContentTableRow/ContentTableRow.styles";

interface ListContentValueProps {
  columnName: string,
  column: PropertySpec,
  row: Record<string, any>,
  entityService: EntityService,
}

const ListContentValue = (props: ListContentValueProps): JSX.Element => {

    const { column, columnName, row, entityService } = props;

    const ListDecorator = entityService.getListDecorator();
    const customComponent = (column as ScalarProperty).component;

    const loadingValue =
      ((column as FkProperty).$ref && row[columnName] && !row[`${columnName}Id`] && (column as FkProperty).type !== 'file')
      || (column as ScalarProperty).type === 'array' && Array.isArray(row[columnName]);

    const enumValues: any = (column as ScalarProperty).enum;
    const value = row[columnName];
    const isBoolean = typeof value === "boolean";

    let response = value;
    if (loadingValue || (row[columnName] === undefined && !customComponent)) {

      response = (
        <Fade
          in={true}
          style={{
            transitionDelay: '1000ms',
          }}
          unmountOnExit
        >
          <LinearProgress color="inherit" />
        </Fade>
      );
    } else if (isBoolean && !enumValues && value) {
      response = <StyledCheckBoxIcon />;
    } else if (isBoolean && !enumValues) {
      response = <StyledCheckBoxOutlineBlankIcon />;
    } else if (row[`${columnName}Link`]) {
      response =
        <StyledTableRowFkLink to={row[`${columnName}Link`]}>
          {value}
        </StyledTableRowFkLink>
    } else {
      response = <ListDecorator field={columnName} row={row} property={column} />
    }

    const prefix = column?.prefix || '';

    return (<>{prefix}{response}</>);
}

export default ListContentValue;
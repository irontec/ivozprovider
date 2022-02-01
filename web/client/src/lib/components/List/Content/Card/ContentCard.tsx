import { CardContent, Typography } from '@mui/material';
import EntityService from 'lib/services/entity/EntityService';
import DeleteRowButton from '../CTA/DeleteRowButton';
import EditRowButton from '../CTA/EditRowButton';
import ViewRowButton from '../CTA/ViewRowButton';
import ListContentValue from '../ListContentValue';
import { StyledCardActions, StyledCard } from './ContentCard.styles';

interface ContentCardProps {
    entityService: EntityService,
    rows: Record<string, any>,
    path: string,
}

const ContentCard = (props:ContentCardProps): JSX.Element => {

  const { entityService, rows, path } = props;

  const columns = entityService.getCollectionColumns();
  const acl = entityService.getAcls();
  const RowActions: React.FunctionComponent | any = entityService.getRowActions();

  return (
    <>
    {rows.map((row:any, rKey: any) => {
      return (
        <StyledCard variant="elevation" sx={{ minWidth: 275 }} key={rKey}>
          <CardContent>
            {Object.keys(columns).map((key: string) => {
              const column = columns[key];
              return (
                <Typography key={key}>
                  <strong>{column.label}:</strong>
                  &nbsp;
                  <ListContentValue
                    columnName={key}
                    column={column}
                    row={row}
                    entityService={entityService}
                  />
                </Typography>
              );
            })}
          </CardContent>
          <StyledCardActions>
            {!acl.update && <ViewRowButton row={row} path={path} />}
            {acl.update && <EditRowButton row={row} path={path} />}
            &nbsp;
            {acl.delete && <DeleteRowButton row={row} entityService={entityService} />}
            {<RowActions row={row} />}
          </StyledCardActions>
        </StyledCard>
      );
    })}
    </>
  );
}

export default ContentCard;
import { CardContent, Typography } from '@mui/material';
import { RouteMapItem } from 'lib/router/routeMapParser';
import EntityService from 'lib/services/entity/EntityService';
import DeleteRowButton from '../CTA/DeleteRowButton';
import EditRowButton from '../CTA/EditRowButton';
import ViewRowButton from '../CTA/ViewRowButton';
import ListContentValue from '../ListContentValue';
import ChildEntityLinks from '../Shared/ChildEntityLinks';
import { StyledCardActions, StyledCard, StyledCardContainer } from './ContentCard.styles';

interface ContentCardProps {
  childEntities: Array<RouteMapItem>,
  entityService: EntityService,
  rows: Record<string, any>,
  ignoreColumn: string | undefined,
  path: string,
}

const ContentCard = (props: ContentCardProps): JSX.Element => {

  const { childEntities, entityService, rows, path, ignoreColumn } = props;
  const entity = entityService.getEntity();
  const ChildDecorator = entity.ChildDecorator;

  const columns = entityService.getCollectionColumns();
  const acl = entityService.getAcls();

  const updateRouteMapItem: RouteMapItem = {
    entity,
    route: `${entity.path}/:id/update`,
  };

  const detailMapItem: RouteMapItem = {
    entity,
    route: `${entity.path}/:id/detailed`,
  };

  const deleteMapItem: RouteMapItem = {
    entity,
    route: `${entity.path}/:id`,
  };

  return (
    <>
      {rows.map((row: any, rKey: any) => {

        return (
          <StyledCard key={rKey}>
            <CardContent>
              {Object.keys(columns).map((key: string) => {
                if (key === ignoreColumn) {
                  return null;
                }
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
              <StyledCardContainer>
                {acl.update && (
                  <ChildDecorator routeMapItem={updateRouteMapItem} row={row}>
                    <EditRowButton row={row} path={path} />
                  </ChildDecorator>
                )}
                {acl.detail && !acl.update && (
                  <ChildDecorator routeMapItem={detailMapItem} row={row}>
                    <ViewRowButton row={row} path={path} />
                  </ChildDecorator>
                )
                }
                {acl.delete && (
                  <ChildDecorator routeMapItem={deleteMapItem} row={row}>
                    <DeleteRowButton row={row} entityService={entityService} />
                  </ChildDecorator>
                )
                }
              </StyledCardContainer>
              <StyledCardContainer>
                <ChildEntityLinks childEntities={childEntities} entityService={entityService} row={row} />
              </StyledCardContainer>
            </StyledCardActions>
          </StyledCard>
        );
      })}
    </>
  );
}

export default ContentCard;
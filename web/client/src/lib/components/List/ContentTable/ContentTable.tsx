/* eslint-disable no-script-url */

import React, { useState } from 'react';
import { Table, TableBody, Tooltip, Fab } from '@mui/material';
import QueueIcon from '@mui/icons-material/Queue';
import SearchIcon from '@mui/icons-material/Search';
import { ContentFilter } from 'lib/components/List/Filter/ContentFilter';
import ContentTableHead from './ContentTableHead';
import ContentTableRow from './ContentTableRow';
import EntityService from 'lib/services/entity/EntityService';
import _ from 'lib/services/translations/translate';
import { StyledActionButtonContainer, StyledLink, StyledFab } from './ContentTable.styles';

interface ContentTableProps {
  path: string,
  entityService: EntityService,
  rows: any,
  preloadData: boolean
}

export default function ContentTable(props: ContentTableProps): JSX.Element {
  const {
    path,
    entityService,
    rows,
    preloadData
  } = props;

  const acl = entityService.getAcls();
  const [showFilters, setShowFilters] = useState(false);
  const handleFiltersClose = () => {
    setShowFilters(false);
  };

  const filterButtonHandler = (/*event: MouseEvent<HTMLButtonElement>*/) => {
    setShowFilters(!showFilters);
  };

  return (
    <React.Fragment>
      <StyledActionButtonContainer>
        <div />
        <div>
          <Tooltip title={_('Search')} arrow>
            <StyledFab onClick={filterButtonHandler}>
              <SearchIcon />
            </StyledFab>
          </Tooltip>
          {acl.create && <StyledLink to={`${path}/create`}>
            <Tooltip title="Add" arrow>
              <Fab color="secondary" size="small" variant="extended">
                <QueueIcon />
              </Fab>
            </Tooltip>
          </StyledLink>}
        </div>
      </StyledActionButtonContainer>

      <ContentFilter
        entityService={entityService}
        open={showFilters}
        handleClose={handleFiltersClose}
        path={path}
        preloadData={preloadData}
      />

      <Table size="medium" sx={{"tableLayout": 'fixed'}}>
        <ContentTableHead
          entityService={entityService}
        />
        <TableBody>
          {rows.map((row: any, key: any) => {
            return (
              <ContentTableRow
                entityService={entityService}
                row={row}
                key={key}
                path={path}
              />
            );
          })}
        </TableBody>
      </Table>
    </React.Fragment >
  );
}
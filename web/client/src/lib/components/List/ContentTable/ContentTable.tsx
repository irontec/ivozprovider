/* eslint-disable no-script-url */

import React, { useState } from 'react';
import { Table, TablePagination, TableBody, Tooltip, Fab } from '@mui/material';
import QueueIcon from '@mui/icons-material/Queue';
import SearchIcon from '@mui/icons-material/Search';
import { ContentFilter, CriteriaFilterValues } from 'lib/components/List/Filter/ContentFilter';
import ContentTableHead from './ContentTableHead';
import ContentTableRow from './ContentTableRow';
import EntityService from 'lib/services/entity/EntityService';
import _ from 'lib/services/translations/translate';
import { createTheme, ThemeProvider } from '@mui/material/styles';
import * as locales from '@mui/material/locale';
import { StyledActionButtonContainer, StyledLink, StyledFab } from './ContentTable.styles';

type sortType = 'asc' | 'desc';

interface ContentTableProps {
  path: string,
  entityService: EntityService,
  headers: { [id: string]: string },
  rowsPerPage: number,
  setRowsPerPage: (loading: number) => void,
  orderBy: string,
  orderDirection: 'asc' | 'desc',
  setSort: (property: string, sortType: sortType) => void,
  page: number,
  setPage: (page: number) => void,
  rows: any,
  uriCriteria: CriteriaFilterValues
}

export default function ContentTable(props: ContentTableProps): JSX.Element {
  const {
    path,
    entityService,
    headers,
    rows,
    rowsPerPage,
    setRowsPerPage,
    orderBy,
    orderDirection,
    setSort,
    page,
    setPage,
    uriCriteria
  } = props;

  const acl = entityService.getAcls();

  const [showFilters, setShowFilters] = useState(false);
  const handleFiltersClose = () => {
    setShowFilters(false);
  };

  const filterButtonHandler = (/*event: MouseEvent<HTMLButtonElement>*/) => {
    setShowFilters(!showFilters);
  };

  const totalItems = parseInt(
    headers['x-total-items'] ?? 0,
    10
  );

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
        preloadData={uriCriteria.length > 0}
      />

      <Table size="medium">
        <ContentTableHead
          entityService={entityService}
          order={orderDirection}
          orderBy={orderBy}
          onRequestSort={setSort}
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
      <ThemeProvider theme={(outerTheme) => createTheme(outerTheme, locales['esES'])}>
        <TablePagination
          component="div"
          page={page - 1}
          rowsPerPage={rowsPerPage}
          rowsPerPageOptions={[1, 10, 50, 100]}
          count={totalItems}
          backIconButtonProps={{
            'aria-label': 'previous page',
          }}
          nextIconButtonProps={{
            'aria-label': 'next page',
          }}
          onPageChange={(event: any, newPage: any) => {
            setPage(newPage + 1);
          }}
          onRowsPerPageChange={(newRowsPerpage: any) => {
            setRowsPerPage(newRowsPerpage.target.value);
          }}
        />
      </ThemeProvider>
    </React.Fragment >
  );
}
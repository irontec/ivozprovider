/* eslint-disable no-script-url */

import React, { useState, MouseEvent } from 'react';
import { Table, TablePagination, TableBody, Tooltip, Fab } from '@mui/material';
import QueueIcon from '@mui/icons-material/Queue';
import SearchIcon from '@mui/icons-material/Search';
import ContentFilter, { getFilterTypeLabel, getFilterLabel } from './ContentFilter';
import ContentTableHead from './ContentTableHead';
import FilterIconFactory from 'icons/FilterIconFactory';
import ContentTableRow from './ContentTableRow';
import EntityService from 'services/Entity/EntityService';
import _ from 'services/Translations/translate';
import { createTheme, ThemeProvider } from '@mui/material/styles';
import * as locales from '@mui/material/locale';
import { StyledActionButtonContainer, StyledLink, StyledFab, StyledChip, StyledChipIcon } from './ContentTable.styles';

interface propsType {
  loading?: boolean,
  path: string,
  setLoading: Function,
  entityService: EntityService,
  headers: { [id: string]: string },
  rowsPerPage: number,
  setRowsPerPage: Function,
  orderBy: string,
  orderDirection: string,
  setSort: Function,
  page: number,
  setPage: Function,
  rows: any,
  where: any,
  setWhere: Function
}

export default function ContentTable(props: propsType) {
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
    setLoading,
    where,
    setWhere
  } = props;

  const columns = entityService.getColumns();
  const acl = entityService.getAcls();

  const [showFilters, setShowFilters] = useState(false);
  const handleFiltersClose = (event: any) => {
    setShowFilters(false);
  };

  const filterButtonHandler = (event: MouseEvent<HTMLButtonElement>) => {
    setShowFilters(!showFilters);
  };

  const [criteria, setCriteria] = useState<any>(where);

  const removeFilter = (fldName: string) => {

    delete criteria[fldName];
    setWhereCondition({
      ...criteria
    });
  }

  const setWhereCondition = (where: any) => {
    setCriteria(where);
    setWhere(where);
  }

  return (
    <React.Fragment>
      <StyledActionButtonContainer>
        <div />
        <div>
          <Tooltip title={_('Search')}>
            <StyledFab onClick={filterButtonHandler}>
              <SearchIcon />
            </StyledFab>
          </Tooltip>
          {acl.create && <StyledLink to={`${path}/create`}>
            <Tooltip title="Add">
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
        currentFilter={criteria}
        setFilters={setWhereCondition}
        path={path}
      />

      <div>
        {Object.keys(criteria).map((fldName: string, idx: number) => {

          if (!criteria[fldName]) {
            return null;
          }

          const fieldStr = columns[fldName].label;

          const icon = (
            <StyledChipIcon fieldName={fieldStr}>
              <FilterIconFactory name={criteria[fldName].type} fontSize='small' />
            </StyledChipIcon>
          );

          const tooltip = (<span>
            {fieldStr} &nbsp;
            {getFilterTypeLabel(criteria[fldName].type)} &nbsp;
            {getFilterLabel(criteria[fldName])}
          </span>);

          return (
            <Tooltip
              key={idx}
              title={tooltip}
            >
              <StyledChip
                icon={icon}
                label={getFilterLabel(criteria[fldName])}
                onDelete={() => {
                  removeFilter(fldName);
                }}
              />
            </Tooltip>
          );
        })}
      </div>

      <Table size="medium">
        <ContentTableHead
          path={path}
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
                setLoading={setLoading}
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
          count={parseInt(headers['x-total-items'], 10)}
          backIconButtonProps={{
            'aria-label': 'previous page',
          }}
          nextIconButtonProps={{
            'aria-label': 'next page',
          }}
          onPageChange={(event: any, newPage: any) => {
            setPage(newPage + 1);
            setLoading(true);
          }}
          onRowsPerPageChange={(newRowsPerpage: any) => {
            setRowsPerPage(newRowsPerpage.target.value);
            setLoading(true);
          }}
        />
      </ThemeProvider>
    </React.Fragment >
  );
}
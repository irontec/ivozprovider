/* eslint-disable no-script-url */

import React, { useState } from 'react';
import { Table, TablePagination, TableBody, Tooltip, Fab } from '@mui/material';
import QueueIcon from '@mui/icons-material/Queue';
import SearchIcon from '@mui/icons-material/Search';
import ContentFilter, { getFilterTypeLabel, getFilterLabel, CriteriaFilterValues } from './ContentFilter';
import ContentTableHead from './ContentTableHead';
import FilterIconFactory from 'icons/FilterIconFactory';
import ContentTableRow from './ContentTableRow';
import EntityService from 'lib/services/entity/EntityService';
import _ from 'lib/services/translations/translate';
import { createTheme, ThemeProvider } from '@mui/material/styles';
import * as locales from '@mui/material/locale';
import { StyledActionButtonContainer, StyledLink, StyledFab, StyledChip, StyledChipIcon } from './ContentTable.styles';

type sortType = 'asc' | 'desc';

interface ContentTableProps {
  loading?: boolean,
  path: string,
  setLoading: (loading: boolean) => void,
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
  where: any,
  setWhere: (where: CriteriaFilterValues) => void
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
    setLoading,
    where,
    setWhere
  } = props;

  const columns = entityService.getColumns();
  const acl = entityService.getAcls();

  const [showFilters, setShowFilters] = useState(false);
  const handleFiltersClose = () => {
    setShowFilters(false);
  };

  const filterButtonHandler = (/*event: MouseEvent<HTMLButtonElement>*/) => {
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
          count={totalItems}
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
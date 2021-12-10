import { useState, useEffect } from 'react';
import FilterDrawer from './FilterDrawer';
import EntityService from 'lib/services/entity/EntityService';
import { Divider } from '@mui/material';
import StyledContentFilterSelector from './ContentFilterSelector.styles';
import { SearchFilterType } from './icons/FilterIconFactory';
import { FilterCriteria } from './FilterCriteria';

export interface CriteriaFilterValue {
    name: string,
    type: SearchFilterType,
    value: string | number | boolean,
}

export type CriteriaFilterValues = Array<CriteriaFilterValue>;

interface ContentFilterMenuProps {
    entityService: EntityService,
    open: boolean,
    handleClose: () => void,
    commitedCriteria: CriteriaFilterValues,
    commitCriteria: (data: CriteriaFilterValues) => void,
    removeFilter: (index: number) => void,
    path: string
}

export function ContentFilter(props: ContentFilterMenuProps): JSX.Element | null {

    const {
        entityService,
        open,
        handleClose,
        commitedCriteria,
        commitCriteria,
        removeFilter,
        path
    } = props;

    const [mounted, setMounted] = useState<boolean>(true);
    const [loading, setLoading] = useState<boolean>(true);
    const [foreignEntities, setForeignEntities] = useState<any>({});
    const [criteria, setCriteria] = useState<CriteriaFilterValues>(commitedCriteria);
    const foreignKeyGetter = entityService.getForeignKeyGetter();

    useEffect(
        () => {
            if (mounted && loading) {
                foreignKeyGetter()
                    .then((foreignEntities: any) => {
                        if (!mounted) {
                            return;
                        }
                        setForeignEntities(foreignEntities);
                        setLoading(false);
                    });
            }

            return function umount() {
                setMounted(false);
            };
        },
        [mounted, loading, foreignKeyGetter]
    );

    const apply = () => {
        commitCriteria(criteria);
        handleClose();
    };

    if (!mounted && loading) {
        return null;
    }

    const addCriteria = (data:CriteriaFilterValue) => {
        const newCriteria: CriteriaFilterValues = [...criteria, data];
        setCriteria(newCriteria);
    }

    const localRemoveFilter = (index: number) => {

        criteria.splice(index, 1);
        setCriteria([
          ...criteria
        ]);
      }

    return (
        <>
            <FilterDrawer
                open={open}
                handleClose={handleClose}
                apply={apply}
            >
                <>
                    <StyledContentFilterSelector
                        entityService={entityService}
                        fkChoices={foreignEntities}
                        addCriteria={addCriteria}
                        path={path}
                    />
                    <Divider />
                    <FilterCriteria
                        criteria={criteria}
                        entityService={entityService}
                        fkChoices={foreignEntities}
                        removeFilter={localRemoveFilter}
                        path={path}
                    />
                </>
            </FilterDrawer>
            <FilterCriteria
                criteria={commitedCriteria}
                entityService={entityService}
                fkChoices={foreignEntities}
                removeFilter={removeFilter}
                path={path}
            />
        </>
    );
}


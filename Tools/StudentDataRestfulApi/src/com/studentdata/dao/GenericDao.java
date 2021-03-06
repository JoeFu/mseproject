package com.studentdata.dao;

import com.studentdata.common.HibernateHelper;

import org.hibernate.Session;
import org.hibernate.SessionFactory;

public abstract class GenericDao<T> {
  public abstract void create(T entity);
  
  public abstract void update(T entity);
  
  public abstract void delete(T entity);
  
  protected void save(T object) {
    Session session = null;
    SessionFactory sessFactory = null;
    try {
      sessFactory = HibernateHelper.getSessionFactory();
      session = sessFactory.openSession();
      org.hibernate.Transaction tr = session.beginTransaction();
      session.save(object);
      tr.commit();
    } catch (Exception ex) {
      ex.printStackTrace();
    } finally {
      sessFactory.close();
    }
  }
}

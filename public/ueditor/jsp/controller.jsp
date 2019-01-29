<%@ page language="java" contentType="text/html; charset=UTF-8"
	import="com.baidu.ueditor.ActionEnter"
    pageEncoding="UTF-8"%>
<%@ page trimDirectiveWhitespaces="true" %>
<%@ page import="com.cindonc.core.util.ConfigUtil" %>
<%
request.setCharacterEncoding("utf-8");
	response.setHeader("Content-Type", "text/html");
	
	String resource_url = ConfigUtil.getProperties("richtxt.ueditor.url");
	String path = request.getContextPath();
	String rootPath = application.getRealPath("/");
	String result = new ActionEnter(request, rootPath).exec();
	
	//out.write(result);
	String action = request.getParameter("action");
	String sysname = System.getProperty("os.name");
	if (action != null && (action.equals("listfile") || action.equals("listimage"))) {
		rootPath = rootPath.replace("\\", "/");
		if("Linux".equals(sysname)){
			//result = result.replaceAll("/upload/article/", path+"/upload/article/");
			result = result.replaceAll("/upload/article/", resource_url+"/gongxiang/health/richtxt/article/");
		}else{
			//windows 下
			//result = result.replaceAll(rootPath, path+"/");
			result = result.replaceAll("../../../../../gongxiang/health/richtxt/article/", resource_url+"/gongxiang/health/richtxt/article/");
		}
	}
	if(action != null && action.equals("uploadimage")){
		//result = result.replaceAll("./upload/article/", path+"/upload/article/");
		result = result.replaceAll("../../../../../gongxiang/health/richtxt/article/", "/gongxiang/health/richtxt/article/");
		//生产目录替换
		//result = result.replaceAll("../../../../../gongxiang/health/richtxt/article/image/","gongxiang/health/richtxt/article/image/");
	}
	out.write(result);
	
%>